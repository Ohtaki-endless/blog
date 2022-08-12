<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('anger')->nullable()->change();
            $table->integer('anxiety')->nullable()->change();
            $table->integer('sad')->nullable()->change();
            $table->integer('relief')->nullable()->change();
            $table->integer('Excite')->nullable()->change();
            $table->integer('joy')->nullable()->change();
            $table->integer('post_id');
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
        Schema::dropIfExists('emotions');
    }
}
