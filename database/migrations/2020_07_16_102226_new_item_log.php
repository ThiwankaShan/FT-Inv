<?php

namespace database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewItemLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newItem_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_code');
            $table->dateTime('bid_open_date');
            $table->string('PO_number');
            $table->string('bidder');
            $table->dateTime('due_date');
            $table->dateTime('request_date');
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
        Schema::dropIfExists('newItem_log');
    }
}
