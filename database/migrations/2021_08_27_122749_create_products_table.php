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
            $table->unsignedBigInteger('tenant_id');
            $table->uuid('uuid');
            $table->string('name')->unique();
            $table->string('url')->unique(); //seria o slug
            $table->string('image');
            $table->double('price',10,2);
            $table->text('description');
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });

        Schema::create('Category_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Category_product');
        Schema::dropIfExists('products');
    }
}
