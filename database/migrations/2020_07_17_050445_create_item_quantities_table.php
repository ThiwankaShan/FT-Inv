<?php


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
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('item_code');
            $table->string('location_code');
            $table->string('subLocation_code');
            $table->string('category_code');
            $table->integer('num_of_sub_items');
            $table->string('type');
            $table->string('GRN_no');
            $table->float('vat%');
            $table->float('vat*rate*vat');
            $table->string('procurement_id');
            $table->float('rate');





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
        Schema::dropIfExists('items');
    }
}
