<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webcomic_id');
            $table->string('name');
            $table->text('homepage');
            $table->string('scraper');
            $table->text('searchstring_comic');
            $table->text('searchstring_title')->nullable();
            $table->text('searchstring_description')->nullable();
            $table->text('searchstring_number')->nullable();
            $table->string('lang')->nullable(); // Language
            $table->boolean('active')->default(true);
            $table->timestamp('last_scraped_at')->nullable();
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
        Schema::dropIfExists('sources');
    }
}
