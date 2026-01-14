<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['lecture', 'journal', 'video', 'book']); // sesuai dengan frontend
            $table->text('description')->nullable();
            $table->string('file_path')->nullable(); // untuk file upload
            $table->string('file_type')->nullable(); // pdf, pptx, docx, etc.
            $table->bigInteger('file_size')->nullable(); // dalam bytes
            $table->string('url')->nullable(); // untuk video links
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
?>