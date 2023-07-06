<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lords', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->json('titles')->nullable(true);
            $table->json('aliases')->nullable(true);
            $table->string('interpretedBy');
            $table->json('seasons_appeared');

            // Relationships
            $table->unsignedBigInteger('house');
            $table->foreign('house')->references('id')->on('houses')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lords');
    }
};
