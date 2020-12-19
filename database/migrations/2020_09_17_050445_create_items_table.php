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
            $table->string('code_item')->primary();
            $table->string('code_location');
            $table->foreign('code_location')->references('code_location')->on('locations')->onUpdate('cascade');
            $table->integer('code_subLocation');
            $table->foreign('code_subLocation')->references('code_subLocation')->on('sub_locations')->onUpdate('cascade');
            $table->integer('code_category');
            $table->foreign('code_category')->references('code_category')->on('categories')->onUpdate('cascade');
            $table->integer('code_subCategory')->nullable();
            $table->foreign('code_subCategory')->references('code_subCategory')->on('sub_categories')->onUpdate('cascade');
            $table->string('type');
            $table->string('serial_no')->nullable()->unique();
            $table->string('model_no')->nullable();
            $table->string('brandName')->nullable();
            $table->integer('GRN_no');
            $table->foreign('GRN_no')->references('GRN_no')->on('grns')->onUpdate('cascade');
            $table->string('procurement_id')->nullable();
            $table->date('purchased_date');
            $table->float('tax');
            $table->float('grossPrice');
            $table->float('netPrice');
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
