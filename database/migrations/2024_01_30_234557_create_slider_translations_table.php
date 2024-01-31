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
        Schema::create('slider_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->string('sub_title');


            $table->unique(['slider_id' , 'locale']);
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_translations');
    }
};
