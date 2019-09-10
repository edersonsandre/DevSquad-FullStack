<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Produtos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('categoria');

            $table->string('nome', 64)->index();
            $table->string('imagem', 200)->nullable();
            $table->text('descricao')->nullable();
            $table->decimal('preco', 8, 2);
            $table->boolean('ativo')->default(1);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
