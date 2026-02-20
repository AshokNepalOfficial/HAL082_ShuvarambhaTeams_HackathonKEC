<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            
            // Assuming you have file_types table
            $table->unsignedBigInteger('filetype_id');
            
            // Assuming you have vectorstore_qualities table
            $table->unsignedBigInteger('vectorstore_quality_id');
            
            $table->boolean('is_vectorized')->default(false);
            $table->string('path');
            $table->unsignedBigInteger('folder_id');
                // File size in bytes
            $table->unsignedBigInteger('filesize');
            $table->timestamps();

            // Foreign keys
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('filetype_id')->references('id')->on('file_type')->onDelete('restrict');
            $table->foreign('vectorstore_quality_id')->references('id')->on('vectorstore_quality')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};