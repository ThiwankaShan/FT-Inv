<?php

namespace database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_quantities', function (Blueprint $table) {
            $table->bigIncrements('q_id');
            $table->string('q_name');
            $table->string('item_code');
            $table->bigInteger('d_id');
            $table->bigInteger('sd_id');
            $table->bigInteger('c_id');
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
        Schema::dropIfExists('item_quantities');
    }
}
