<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add foreign key to table 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        // Add foreign key to table 'categories'
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Add foreign key to table 'products'
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        // Add foreign key to table 'comments'
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // Add foreign key to table 'rates'
        Schema::table('rates', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // Add foreign key to table 'discounts'
        Schema::table('discounts', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('discount_program_id')->references('id')->on('discounts')->onDelete('cascade');
        });

        // Add foreign key to table 'orders'
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Add foreign key to table 'order_items'
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        // Add foreign key to table 'product_attributes'
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });

        // Add foreign key to table 'products_colors'
        Schema::table('products_colors', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        });

        // Add foreign key to table 'images'
        Schema::table('images', function (Blueprint $table) {
            $table->foreign('product_color_id')->references('id')->on('products_colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_parent_id_foreign');
            $table->dropForeign('categories_user_id_foreign');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_user_id_foreign');
            $table->dropForeign('products_category_id_foreign');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_parent_id_foreign');
            $table->dropForeign('comments_user_id_foreign');
            $table->dropForeign('comments_product_id_foreign');
        });
        Schema::table('rates', function (Blueprint $table) {
            $table->dropForeign('rates_user_id_foreign');
            $table->dropForeign('rates_product_id_foreign');
        });
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropForeign('discounts_product_id_foreign');
            $table->dropForeign('discounts_discount_program_id_foreign');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_order_id_foreign');
            $table->dropForeign('order_items_product_id_foreign');
        });
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->dropForeign('product_attributes_product_id_foreign');
            $table->dropForeign('product_attributes_color_id_foreign');
            $table->dropForeign('product_attributes_size_id_foreign');
        });
        Schema::table('products_colors', function (Blueprint $table) {
            $table->dropForeign('products_colors_product_id_foreign');
            $table->dropForeign('products_colors_color_id_foreign');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_product_color_id_foreign');
        });
    }

}
