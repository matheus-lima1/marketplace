<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id'); // Loja Matheus

            $table->unsignedBigInteger('user_id'); // não é autoincremento e se relaciona com Users

            $table->string('name'); // nome da Loja
            $table->string('description'); // descrição
            $table->string('phone'); // celular
            $table->string('slug'); // loja-matheus

            $table->timestamps(); // Usuario tem lojas (1-n)

            // user_id se relaciona com o atributo 'id' da tabela 'users' (relação 1-n com stores)
            $table->foreign('user_id')->references('id')->on('users'); // stores_user_id_foreign

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
