<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->date('date');
            $table->unsignedBigInteger('folder_id');
            $table->enum('type', ['Partnyorluq', 'Xidmət','Alqı-satqı']);
            $table->enum('shopping', ['Biz alırıq', 'Biz satırıq']);
            $table->string('other_side_type');
            $table->string('other_side_name');
            $table->double('price');
            $table->string('currency');
            $table->string('tag');
            $table->string('file');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
        Schema::table('contracts',function (Blueprint $table){
            $table->dropColumn('tag');
        });
    }
};
