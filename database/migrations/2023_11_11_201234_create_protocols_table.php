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
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->date('date');
            $table->unsignedBigInteger("contract_id");
            $table->string('other_side_name');
            $table->double('price');
            $table->string('currency');
            $table->string('tag');
            $table->string('file');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign("contract_id")->references("id")->on("contracts")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protocols');
    }
};
