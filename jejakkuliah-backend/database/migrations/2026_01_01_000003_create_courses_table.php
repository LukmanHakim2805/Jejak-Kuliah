<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/2024_01_01_000003_create_courses_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g., "Basis Data", "Jaringan Komputer"
            $table->string('code')->nullable(); // e.g., "CS101"
            $table->integer('credits')->nullable(); // SKS
            $table->string('lecturer')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

?>

// database/migrations/2024_01_01_000004_create_materials_table.php
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

// database/migrations/2024_01_01_000005_create_books_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->year('publication_year')->nullable();
            $table->string('isbn')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

// database/migrations/2024_01_01_000006_create_journals_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('authors')->nullable();
            $table->string('journal_name')->nullable();
            $table->year('publication_year')->nullable();
            $table->string('doi')->nullable();
            $table->text('abstract')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};

// database/migrations/2024_01_01_000007_create_videos_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url'); // YouTube, Vimeo, etc.
            $table->string('platform')->nullable(); // youtube, vimeo, local
            $table->integer('duration')->nullable(); // dalam detik
            $table->string('thumbnail')->nullable();
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

// database/migrations/2024_01_01_000008_create_personal_access_tokens_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};