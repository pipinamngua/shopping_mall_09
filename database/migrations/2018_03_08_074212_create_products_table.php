<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('product_name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->float('rate_point')->default(0);
            $table->float('popular_level')->default(0);
            $table->float('original_price');
            $table->tinyInteger('status');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }

}
