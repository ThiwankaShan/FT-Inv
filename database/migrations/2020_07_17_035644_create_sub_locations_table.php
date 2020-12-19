<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_locations', function (Blueprint $table) {
            $table->integer('code_subLocation');
            $table->string('name_subLocation');
            $table->string('code_Location');
            $table->foreign('code_Location')->references('code_Location')->on('locations')->onUpdate('cascade');
            $table->primary(['code_subLocation','code_Location']);
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
        Schema::dropIfExists('sub_locations');
    }
    }

