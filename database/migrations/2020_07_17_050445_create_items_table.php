<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('item_code');
            $table->string('location_code');
            $table->string('subLocation_code');
            $table->string('category_code');
            $table->string('subCategory_code');
            $table->string('type');
            $table->string('supplier_name');
            $table->string('GRN_no');
            $table->date('purchased_date');
            $table->string('serialNumber')->nullable();
            $table->float('vat');
            $table->float('vat_rate_vat');
            $table->string('procurement_id')->nullable();
            $table->float('rate',10,5);
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
