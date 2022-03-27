<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outlet_id');
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade');
            $table->string('item_name');
            $table->unsignedBigInteger('item_cat_id');
            $table->foreign('item_cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->double('item_price');
            $table->string('item_image')->nullable();
            $table->string('item_description')->nullable();
            $table->integer('itemDiscount_status')->default(0);
            $table->double('item_discount')->nullable();
            $table->string('item_discount_type')->nullable();
            $table->integer('itemVat_status')->default(0);
            $table->double('item_vat')->nullable();
            $table->integer('has_extras')->default(0);
            $table->integer('is_featured')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('menus');
    }
}
