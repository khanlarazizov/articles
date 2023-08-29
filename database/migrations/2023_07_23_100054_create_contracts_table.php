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
            $table->date('date')->nullable();
            $table->enum('type', ['Partnyorluq', 'Xidmət','Alqı-satqı']);
            $table->enum('shopping', ['Biz alırıq', 'Biz satırıq']);
            $table->string('other_side_type')->nullable();
            $table->string('other_side_name')->nullable();
            $table->double('price')->nullable();
            $table->string('currency')->nullable();
            $table->string('tag');
            $table->string('file');
            $table->timestamps();
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
