<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string("name",50);
            $table->smallInteger("max_guests");
            $table->smallInteger("num_rooms");
            $table->smallInteger("num_wc");
            $table->smallInteger("num_beds");
            $table->text("description");
            $table->string("address");
            $table->smallInteger("square_footage");
            $table->foreignId("location_id")->constrained();
            $table->foreignId("user_id")->constrained();
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
        Schema::dropIfExists('venues');
    }
}
