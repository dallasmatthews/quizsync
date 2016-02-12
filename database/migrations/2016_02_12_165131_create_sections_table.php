<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section_title');
            $table->string('section_description')->nullable();
            $table->smallInteger('order_by')->unsigned();
            $table->integer('quiz_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            // @todo Add Foreign key to Quiz
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sections');
    }
}