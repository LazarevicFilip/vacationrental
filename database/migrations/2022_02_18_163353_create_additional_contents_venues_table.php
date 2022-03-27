<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalContentsVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_contents_venues', function (Blueprint $table) {
            $table->id();
            $table->foreignId("venue_id")->constrained();
            $table->foreignId("additional_content_id")->constrained();
            $table->unique(["venue_id","additional_content_id"],"venue_a_content_unique");
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
        Schema::dropIfExists('additional_contents_venues');
    }
}
