# # import os
# # import uuid
# # import logging
# # from pathlib import Path
# # from typing import List, Dict, Optional, Any

# # import uvicorn
# # from fastapi import FastAPI, Form, HTTPException
# # from pydantic import BaseModel

# # # LlamaIndex Core
# # from llama_index.core import (
# #     VectorStoreIndex, 
# #     StorageContext, 
# #     Settings, 
# #     SimpleDirectoryReader, 
# #     load_index_from_storage
# # )
# # from llama_index.core.node_parser import SentenceSplitter
# # from llama_index.embeddings.ollama import OllamaEmbedding
# # from llama_index.llms.ollama import Ollama
# # from llama_index.core.vector_stores import MetadataFilters, MetadataFilter
# # from llama_index.core.llms import ChatMessage as LlamaChatMessage

# # # --- 1. CONFIGURATION ---
# # logging.basicConfig(level=logging.INFO)
# # logger = logging.getLogger("AI_WORKER")

# # # This is your Laravel Storage Root
# # BASE_STORAGE_PATH = Path(r"C:\Users\PREDATOR\Desktop\StartupChatbotSystem\frontend\storage\app\public")
# # # AI Index files will stay here
# # INDEX_STORAGE_DIR = BASE_STORAGE_PATH / "ai_index"

# # OLLAMA_URL = "http://localhost:11434"

# # # Set up global settings
# # Settings.embed_model = OllamaEmbedding(model_name="nomic-embed-text", base_url=OLLAMA_URL)
# # Settings.llm = Ollama(model="llama3.2", base_url=OLLAMA_URL, request_timeout=300.0)

# # # --- 2. THE INDEX MANAGER ---
# # class IndexManager:
# #     def __init__(self, storage_dir: Path):
# #         self.storage_dir = storage_dir
# #         self.index = self._load_or_create()

# #     def _load_or_create(self):
# #         docstore_path = self.storage_dir / "docstore.json"
# #         if docstore_path.exists():
# #             logger.info(f">>> Loading index from {self.storage_dir}")
# #             try:
# #                 storage_context = StorageContext.from_defaults(persist_dir=str(self.storage_dir))
# #                 return load_index_from_storage(storage_context)
# #             except Exception as e:
# #                 logger.error(f"Load failed: {e}")
        
# #         logger.info(">>> Creating fresh index...")
# #         self.storage_dir.mkdir(parents=True, exist_ok=True)
# #         storage_context = StorageContext.from_defaults()
# #         index = VectorStoreIndex([], storage_context=storage_context)
# #         index.storage_context.persist(persist_dir=str(self.storage_dir))
# #         return index

# #     def add_documents(self, nodes):
# #         self.index.insert_nodes(nodes)
# #         self.index.storage_context.persist(persist_dir=str(self.storage_dir))
# #         logger.info(f">>> Total chunks in store: {len(self.index.docstore.docs)}")

# # manager = IndexManager(INDEX_STORAGE_DIR)
# # app = FastAPI(title="Laravel AI Worker")

# # # --- 3. SCHEMAS ---
# # class ChatMessage(BaseModel):
# #     role: str
# #     content: str

# # class FewShotExample(BaseModel):
# #     user_input: str
# #     assistant_response: str

# # class ChatRequest(BaseModel):
# #     query: str
# #     history: List[ChatMessage]
# #     file_group_ids: List[str]
# #     system_prompt: str = "You are a professional assistant."
# #     few_shot_examples: Optional[List[FewShotExample]] = []

# # # --- 4. ROUTES ---

# # @app.post("/vectorize")
# # async def vectorize(
# #     file_path: str = Form(...),
# #     embedding_quality: str = Form(...),
# #     file_type: str = Form(...)
# # ):
# #     try:
# #         # --- PATH RESOLUTION LOGIC ---
# #         incoming_path = Path(file_path)
        
# #         # If Laravel sends "uploads/1/file.txt", we combine it with the BASE_STORAGE_PATH
# #         # If Laravel sends a full absolute path, we use it as is
# #         if not incoming_path.is_absolute():
# #             full_physical_path = BASE_STORAGE_PATH / incoming_path
# #             print(full_physical_path)
# #         else:
# #             full_physical_path = incoming_path

# #         logger.info(f"Looking for file at: {full_physical_path}")

# #         if not full_physical_path.exists():
# #             raise HTTPException(
# #                 status_code=404, 
# #                 detail=f"Physical file not found. Checked: {full_physical_path}"
# #             )

# #         # 1. Load Document
# #         reader = SimpleDirectoryReader(input_files=[str(full_physical_path)])
# #         documents = reader.load_data()
        
# #         # 2. Parse
# #         size = 1024 if embedding_quality == "low" else (512 if embedding_quality == "medium" else 256)
# #         parser = SentenceSplitter(chunk_size=size, chunk_overlap=30)
# #         nodes = parser.get_nodes_from_documents(documents)

# #         # 3. Metadata
# #         file_group_id = str(uuid.uuid4())
# #         for node in nodes:
# #             node.metadata = {
# #                 "file_group_id": file_group_id,
# #                 "file_name": full_physical_path.name,
# #                 "file_type": file_type
# #             }

# #         # 4. Save
# #         manager.add_documents(nodes)

# #         return {
# #             "file_group_id": file_group_id,
# #             "status": "success",
# #             "full_path_processed": str(full_physical_path)
# #         }
# #     except Exception as e:
# #         logger.error(f"Vectorize Error: {e}")
# #         raise HTTPException(status_code=500, detail=str(e))

# # @app.post("/chat")
# # async def chat(req: ChatRequest):
# #     try:
# #         if not manager.index.docstore.docs:
# #             return {"answer": "AI Knowledge base is empty.", "sources": []}

# #         filters = MetadataFilters(
# #             filters=[MetadataFilter(key="file_group_id", value=gid) for gid in req.file_group_ids],
# #             condition="or"
# #         )

# #         shot_text = ""
# #         if req.few_shot_examples:
# #             shot_text = "\n\nExamples:\n" + "\n".join(
# #                 [f"User: {ex.user_input}\nAssistant: {ex.assistant_response}" for ex in req.few_shot_examples]
# #             )
        
# #         chat_engine = manager.index.as_chat_engine(
# #             chat_mode="context",
# #             filters=filters,
# #             system_prompt=f"{req.system_prompt}{shot_text}",
# #             similarity_top_k=3
# #         )
        
# #         history = [LlamaChatMessage(role=m.role, content=m.content) for m in req.history]
# #         response = chat_engine.chat(req.query, chat_history=history)

# #         sources = [{
# #             "text": n.node.get_content()[:200],
# #             "file_id": n.node.metadata.get("file_group_id"),
# #             "file_name": n.node.metadata.get("file_name")
# #         } for n in response.source_nodes]

# #         return {"answer": response.response, "sources": sources}
# #     except Exception as e:
# #         logger.error(f"Chat Error: {e}")
# #         raise HTTPException(status_code=500, detail=str(e))

# # if __name__ == "__main__":
# #     uvicorn.run(app, host="0.0.0.0", port=8003)




# import os
# import uuid
# import logging
# from pathlib import Path
# from typing import List, Dict, Optional, Any

# import uvicorn
# from fastapi import FastAPI, Form, HTTPException
# from pydantic import BaseModel

# # LlamaIndex Core
# from llama_index.core import (
#     VectorStoreIndex, 
#     StorageContext, 
#     Settings, 
#     SimpleDirectoryReader, 
#     load_index_from_storage,
#     QueryBundle
# )
# from llama_index.core.node_parser import SentenceSplitter
# from llama_index.embeddings.ollama import OllamaEmbedding
# from llama_index.llms.ollama import Ollama
# from llama_index.core.vector_stores import MetadataFilters, MetadataFilter, FilterOperator
# from llama_index.core.llms import ChatMessage as LlamaChatMessage, MessageRole
# from llama_index.core.chat_engine import CondensePlusContextChatEngine

# # --- 1. CONFIGURATION ---
# logging.basicConfig(level=logging.INFO)
# logger = logging.getLogger("AI_WORKER")

# BASE_STORAGE_PATH = Path(r"C:\Users\PREDATOR\Desktop\StartupChatbotSystem\frontend\storage\app\public")
# INDEX_STORAGE_DIR = BASE_STORAGE_PATH / "ai_index"
# OLLAMA_URL = "http://localhost:11434"

# # Optimized Settings
# Settings.embed_model = OllamaEmbedding(model_name="nomic-embed-text", base_url=OLLAMA_URL)
# Settings.llm = Ollama(model="llama3.2", base_url=OLLAMA_URL, request_timeout=300.0, context_window=4096)
# Settings.chunk_size = 512
# Settings.chunk_overlap = 50

# # --- 2. THE INDEX MANAGER ---
# class IndexManager:
#     def __init__(self, storage_dir: Path):
#         self.storage_dir = storage_dir
#         self.index = self._load_or_create()

#     def _load_or_create(self):
#         self.storage_dir.mkdir(parents=True, exist_ok=True)
#         if (self.storage_dir / "docstore.json").exists():
#             try:
#                 storage_context = StorageContext.from_defaults(persist_dir=str(self.storage_dir))
#                 return load_index_from_storage(storage_context)
#             except Exception as e:
#                 logger.error(f"Load failed: {e}")
        
#         storage_context = StorageContext.from_defaults()
#         index = VectorStoreIndex([], storage_context=storage_context)
#         index.storage_context.persist(persist_dir=str(self.storage_dir))
#         return index

#     def add_documents(self, nodes):
#         self.index.insert_nodes(nodes)
#         self.index.storage_context.persist(persist_dir=str(self.storage_dir))

# manager = IndexManager(INDEX_STORAGE_DIR)
# app = FastAPI(title="Laravel AI Worker")

# # --- 3. SCHEMAS ---
# class ChatMessage(BaseModel):
#     role: str
#     content: str

# class FewShotExample(BaseModel):
#     user_input: str
#     assistant_response: str

# class ChatRequest(BaseModel):
#     query: str
#     history: List[ChatMessage]
#     file_group_ids: List[str]
#     system_prompt: str = "You are a professional assistant."
#     few_shot_examples: Optional[List[FewShotExample]] = []

# # --- 4. ROUTES ---

# @app.post("/vectorize")
# async def vectorize(
#     file_path: str = Form(...),
#     embedding_quality: str = Form(...),
#     file_type: str = Form(...)
# ):
#     try:
#         incoming_path = Path(file_path)
#         full_physical_path = incoming_path if incoming_path.is_absolute() else BASE_STORAGE_PATH / incoming_path

#         if not full_physical_path.exists():
#             raise HTTPException(status_code=404, detail=f"File not found: {full_physical_path}")

#         # Improved loading for various file types
#         reader = SimpleDirectoryReader(input_files=[str(full_physical_path)], filename_as_id=True)
#         documents = reader.load_data()
        
#         # Dynamic Chunking based on quality
#         chunk_size = 1024 if embedding_quality == "low" else (512 if embedding_quality == "medium" else 256)
#         parser = SentenceSplitter(chunk_size=chunk_size, chunk_overlap=int(chunk_size * 0.1))
#         nodes = parser.get_nodes_from_documents(documents)

#         file_group_id = str(uuid.uuid4())
#         for node in nodes:
#             node.metadata = {
#                 "file_group_id": file_group_id,
#                 "file_name": full_physical_path.name,
#                 "file_type": file_type,
#                 "path": str(full_physical_path)
#             }

#         manager.add_documents(nodes)

#         return {
#             "file_group_id": file_group_id,
#             "status": "success",
#             "full_path_processed": str(full_physical_path)
#         }
#     except Exception as e:
#         logger.error(f"Vectorize Error: {e}")
#         raise HTTPException(status_code=500, detail=str(e))

# @app.post("/chat")
# async def chat(req: ChatRequest):
#     try:
#         if not manager.index.docstore.docs:
#             return {"answer": "AI Knowledge base is empty.", "sources": []}

#         # Filtering logic
#         filters = MetadataFilters(
#             filters=[MetadataFilter(key="file_group_id", value=gid, operator=FilterOperator.EQ) for gid in req.file_group_ids],
#             condition="or"
#         )

#         # Constructing refined system prompt with few-shots
#         refined_system_prompt = req.system_prompt
#         if req.few_shot_examples:
#             examples_str = "\n".join([f"User: {ex.user_input}\nAssistant: {ex.assistant_response}" for ex in req.few_shot_examples])
#             refined_system_prompt += f"\n\nFollow these examples for tone and format:\n{examples_str}"

#         # Setup Chat Engine (CondensePlusContext handles history better)
#         chat_engine = CondensePlusContextChatEngine.from_defaults(
#             retriever=manager.index.as_retriever(filters=filters, similarity_top_k=5),
#             system_prompt=refined_system_prompt,
#             verbose=False
#         )
        
#         # Map history to LlamaIndex format
#         llama_history = [
#             LlamaChatMessage(role=m.role, content=m.content) 
#             for m in req.history
#         ]

#         # Generate response
#         response = chat_engine.chat(req.query, chat_history=llama_history)

#         # Deduplicate and format sources
#         seen_sources = set()
#         sources = []
#         for n in response.source_nodes:
#             f_id = n.node.metadata.get("file_group_id")
#             if f_id not in seen_sources:
#                 sources.append({
#                     "text": n.node.get_content()[:250] + "...",
#                     "file_id": f_id,
#                     "file_name": n.node.metadata.get("file_name")
#                 })
#                 seen_sources.add(f_id)

#         return {
#             "answer": response.response.strip(),
#             "sources": sources
#         }
#     except Exception as e:
#         logger.error(f"Chat Error: {e}")
#         raise HTTPException(status_code=500, detail=str(e))

# if __name__ == "__main__":
#     uvicorn.run(app, host="0.0.0.0", port=8003)

import os
import uuid
import logging
from pathlib import Path
from typing import List, Optional

import uvicorn
from fastapi import FastAPI, Form, HTTPException
from pydantic import BaseModel
from PIL import Image
import pytesseract
from pdf2image import convert_from_path

# --- LlamaIndex Core (v0.10+ Standards) ---
from llama_index.core import (
    VectorStoreIndex,
    StorageContext,
    Settings,
    SimpleDirectoryReader,
    load_index_from_storage,
    Document
)
from llama_index.core.node_parser import SentenceSplitter
from llama_index.embeddings.ollama import OllamaEmbedding
from llama_index.llms.ollama import Ollama
from llama_index.core.vector_stores import MetadataFilters, MetadataFilter, FilterOperator
from llama_index.core.llms import ChatMessage as LlamaChatMessage
from llama_index.core.chat_engine import CondensePlusContextChatEngine

# Setup logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger("AI_WORKER")

# --- OCR CONFIGURATION (Windows Specific) ---
# If tesseract is not in your PATH, uncomment and point to your .exe:
pytesseract.pytesseract.tesseract_cmd = r'D:\TesseractOCRFiles\tesseract.exe'

# --- STORAGE PATHS ---
BASE_STORAGE_PATH = Path(r"C:\Users\PREDATOR\Desktop\StartupChatbotSystem\frontend\storage\app\public")
INDEX_STORAGE_DIR = BASE_STORAGE_PATH / "ai_index"
OLLAMA_URL = "http://localhost:11434"

# --- SETTINGS (Global Configuration) ---
Settings.embed_model = OllamaEmbedding(model_name="nomic-embed-text", base_url=OLLAMA_URL)
Settings.llm = Ollama(model="llama3.2", base_url=OLLAMA_URL, request_timeout=300.0, context_window=4096)
Settings.chunk_size = 512
Settings.chunk_overlap = 50

# --- INDEX MANAGER ---
class IndexManager:
    def __init__(self, storage_dir: Path):
        self.storage_dir = storage_dir
        self.index = self._load_or_create()

    def _load_or_create(self):
        self.storage_dir.mkdir(parents=True, exist_ok=True)
        # Check if the vector_store.json exists (more reliable than docstore for index health)
        if (self.storage_dir / "vector_store.json").exists():
            try:
                storage_context = StorageContext.from_defaults(persist_dir=str(self.storage_dir))
                return load_index_from_storage(storage_context)
            except Exception as e:
                logger.error(f"Load failed, creating new index: {e}")
        
        # Create empty index if none exists
        storage_context = StorageContext.from_defaults()
        index = VectorStoreIndex([], storage_context=storage_context)
        index.storage_context.persist(persist_dir=str(self.storage_dir))
        return index

    def add_nodes(self, nodes):
        self.index.insert_nodes(nodes)
        self.index.storage_context.persist(persist_dir=str(self.storage_dir))

manager = IndexManager(INDEX_STORAGE_DIR)
app = FastAPI(title="Universal Laravel AI Worker")

# --- SCHEMAS ---
class ChatMessage(BaseModel):
    role: str
    content: str

class FewShotExample(BaseModel):
    user_input: str
    assistant_response: str

class ChatRequest(BaseModel):
    query: str
    history: List[ChatMessage]
    file_group_ids: List[str]
    system_prompt: str = "You are a professional assistant."
    few_shot_examples: Optional[List[FewShotExample]] = []

# --- OCR UTILITIES ---
def ocr_pdf_or_image(file_path: Path) -> str:
    text = ""
    ext = file_path.suffix.lower()
    try:
        if ext in [".png", ".jpg", ".jpeg"]:
            img = Image.open(file_path)
            text = pytesseract.image_to_string(img)
        elif ext == ".pdf":
            # Note: requires poppler installed on Windows
            images = convert_from_path(str(file_path))
            for img in images:
                text += pytesseract.image_to_string(img) + "\n"
    except Exception as e:
        logger.error(f"OCR failed for {file_path}: {e}")
    return text

# --- ROUTES ---
@app.post("/vectorize")
async def vectorize(
    file_path: str = Form(...), 
    embedding_quality: str = Form(...), 
    file_type: str = Form(...)
):
    try:
        full_path = Path(file_path) if Path(file_path).is_absolute() else BASE_STORAGE_PATH / file_path
        if not full_path.exists():
            raise HTTPException(status_code=404, detail=f"File not found: {full_path}")

        ext = full_path.suffix.lower()
        
        # Decide if OCR or Standard Reader
        if ext in [".png", ".jpg", ".jpeg"] or (ext == ".pdf" and file_type == "scanned"):
            text = ocr_pdf_or_image(full_path)
            if not text.strip():
                raise HTTPException(status_code=500, detail="OCR failed or no text detected")
            documents = [Document(text=text, metadata={"file_name": full_path.name})]
        else:
            reader = SimpleDirectoryReader(input_files=[str(full_path)])
            documents = reader.load_data()

        # Dynamic chunking
        chunk_size = 1024 if embedding_quality == "low" else (512 if embedding_quality == "medium" else 256)
        parser = SentenceSplitter(chunk_size=chunk_size, chunk_overlap=int(chunk_size*0.1))
        nodes = parser.get_nodes_from_documents(documents)

        file_group_id = str(uuid.uuid4())
        for node in nodes:
            node.metadata.update({
                "file_group_id": file_group_id,
                "file_name": full_path.name,
                "file_type": file_type,
                "path": str(full_path)
            })

        manager.add_nodes(nodes)
        return {"file_group_id": file_group_id, "status": "success"}
        
    except Exception as e:
        logger.error(f"Vectorize Error: {e}")
        raise HTTPException(status_code=500, detail=str(e))

@app.post("/chat")
async def chat(req: ChatRequest):
    try:
        # Check if index has data
        if not manager.index.index_struct:
            return {"answer": "AI Knowledge base is empty.", "sources": []}

        # Filter by file_group_ids
        filters = None
        if req.file_group_ids:
            filters = MetadataFilters(
                filters=[MetadataFilter(key="file_group_id", value=gid, operator=FilterOperator.EQ) for gid in req.file_group_ids],
                condition="or"
            )

        refined_prompt = req.system_prompt
        if req.few_shot_examples:
            examples = "\n".join([f"User: {ex.user_input}\nAssistant: {ex.assistant_response}" for ex in req.few_shot_examples])
            refined_prompt += f"\n\nExamples:\n{examples}"

        chat_engine = CondensePlusContextChatEngine.from_defaults(
            retriever=manager.index.as_retriever(filters=filters, similarity_top_k=5),
            system_prompt=refined_prompt
        )

        llama_history = [LlamaChatMessage(role=m.role, content=m.content) for m in req.history]
        response = chat_engine.chat(req.query, chat_history=llama_history)

        # Source tracking
        sources = []
        seen_files = set()
        for n in response.source_nodes:
            fname = n.node.metadata.get("file_name")
            if fname not in seen_files:
                sources.append({"file_name": fname, "text": n.node.get_content()[:200]})
                seen_files.add(fname)

        return {"answer": response.response.strip(), "sources": sources}

    except Exception as e:
        logger.error(f"Chat Error: {e}")
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    # Change port to 8004 if 8003 is still blocked
    uvicorn.run(app, host="0.0.0.0", port=8003)