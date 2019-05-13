<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComandasTable extends Migration
{
    /**
     * Run the migrations.
     *status -1 = denied
     *status 0 = pending
     *status 1 = aproved
     * @return void
     */
    public function up()
    {
        Schema::create('comandas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('medicament');
            $table->integer('cantitate');
            $table->bigInteger('idSectie')->unsigned();
            $table->foreign('idSectie')->references('id')->on('secties')->onDelete('cascade') ;
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('comandas');
    }
}
