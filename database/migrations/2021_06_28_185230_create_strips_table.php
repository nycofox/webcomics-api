<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id');
            $table->date('date');
            $table->string('image_path');
            $table->string('image_hash');
            $table->unsignedBigInteger('image_filesize');
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('transcript')->nullable();
            $table->string('number')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strips');
    }
}
