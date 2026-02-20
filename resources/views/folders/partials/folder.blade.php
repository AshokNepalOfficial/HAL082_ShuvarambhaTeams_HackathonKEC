<div style="margin-left: {{ $level ?? 0 }}px; border-left: 1px dashed #ccc; padding-left: 10px; margin-top: 10px;">
    <h4>
        {{ $folder->name }}
        <!-- Folder Rename Form -->
        <form action="{{ route('folders.rename', $folder->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="text" name="name" placeholder="Rename" required>
            <button type="submit">Rename</button>
        </form>
        <!-- Folder Delete Form -->
        <form action="{{ route('folders.destroy', $folder->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete folder and all contents?')">Delete</button>
        </form>
    </h4>

    <!-- Upload file to this folder -->
    <form action="{{ route('files.store', $folder->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload File</button>
    </form>

    <!-- Files list -->
    <ul>
        @foreach ($folder->files as $file)
            <li>
                <a href="{{ asset('storage/' . $file->path) }}" target="_blank">{{ $file->filename }}</a>

                <!-- File Rename Form -->
                <form action="{{ route('files.rename', $file->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="text" name="filename" placeholder="Rename" required>
                    <button type="submit">Rename</button>
                </form>

                <!-- File Delete Form -->
                <form action="{{ route('files.destroy', $file->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this file?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <!-- Nested folders -->
    @if($folder->children)
        @foreach ($folder->children as $child)
            @include('folders.partials.folder', ['folder' => $child, 'level' => ($level ?? 0) + 20])
        @endforeach
    @endif
</div>