<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id');
            $table->integer('number');
//            $table->boolean('status');
            $table->enum('document_type', ['Müqavilə', 'Müqaviləyə Əlavə', 'Protokol', 'Təhvil-təslim aktı']);
            $table->date('date');
            $table->integer('price');
            $table->string('currency');
            $table->string('tag');
            $table->string('file');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('folder_id')->on('folders')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
