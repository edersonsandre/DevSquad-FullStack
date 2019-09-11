<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_upload', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user');

            $table->text('file', 100);
            $table->boolean('processado')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos_upload');
    }
}
