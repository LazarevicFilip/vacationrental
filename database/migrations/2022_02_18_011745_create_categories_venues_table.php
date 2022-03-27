<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("venue_id")->constrained();
            $table->foreignId("category_id")->constrained();
            $table->unique(["venue_id","category_id"],"venue_category_unique");
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
        Schema::dropIfExists('venues_categories');
    }
}
