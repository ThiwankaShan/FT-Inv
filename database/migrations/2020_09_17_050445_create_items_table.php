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
            $table->string('item_code')->primary();
            $table->string('location_code');
            $table->foreign('location_code')->references('location_code')->on('locations')->onUpdate('cascade');
            $table->integer('subLocation_code');
            $table->foreign('subLocation_code')->references('subLocation_code')->on('sub_locations')->onUpdate('cascade');
            $table->integer('category_code');
            $table->foreign('category_code')->references('category_code')->on('categories')->onUpdate('cascade');
            $table->integer('subCategory_code');
            $table->foreign('subCategory_code')->references('subCategory_code')->on('sub_categories')->onUpdate('cascade');
            $table->string('type');
            $table->string('serial_number')->nullable()->unique();
            $table->string('model_number')->nullable();
            $table->string('brandName')->nullable();
            $table->integer('GRN_number');
            $table->foreign('GRN_number')->references('GRN_number')->on('grns')->onUpdate('cascade');
            $table->string('procurement_id')->nullable();
            $table->date('purchased_date');
            $table->string('supplier_name');
            $table->float('tax');
            $table->float('gross_price');
            $table->float('net_price');
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
