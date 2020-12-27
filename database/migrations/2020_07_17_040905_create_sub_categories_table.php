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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->integer('subCategory_code');
            $table->string('subCategory_name');
            $table->integer('category_code');
            $table->foreign('category_code')->references('category_code')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['subCategory_code','category_code']);
            $table->softDeletes();
            $table->timestamps();     
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('sub_categories')->insert(
            array(
                'subCategory_code' => 000,
                'subCategory_name' => 'Default',
                'category_code' =>-1,            
            ));

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
