<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            // relacionamente com a tabela 'store'
            $table->unsignedBigInteger('store_id');

            $table->string('name'); // nome do produto 
            $table->string('description'); // descricao
            $table->text('body'); //
            $table->decimal('price',10,2); // preço
            $table->string('slug'); // url

            $table->timestamps();

            // store_id se relaciona com o atributo 'id' da tabela 'store'
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade'); 
            // products_store_id_foreign
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
