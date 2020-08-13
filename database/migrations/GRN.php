<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GRN', function (Blueprint $table) {
            $table->string('GRN_no')->primarykey();
            $table->date('GRN_date');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('supplier_code');
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
        Schema::dropIfExists('GRN');
    }
