<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Investiments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investiments', function (Blueprint $table) {
            $table->id();
            $table->string('cv');
            $table->unsignedBigInteger('action_id')->nullable()->default(null);
            $table->string('price')->nullable()->default(null);
            $table->integer('amount')->nullable()->default(null);
            $table->string('type')->nullable()->default(null);
            $table->double('rate', 8, 2)->nullable()->default(null);
            $table->double('value', 8, 2)->nullable()->default(null);
            $table->string('due_date')->nullable()->default(null);

            $table->foreign('action_id')
                ->references('id')->on('actions');

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
        Schema::dropIfExists('investiments');
    }
}
