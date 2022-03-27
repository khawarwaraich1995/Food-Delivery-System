<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('outlet_logo')->nullable();
            $table->string('email');
            $table->string('country');
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->float('minimum_order')->default(0.00);
            $table->string('phone')->nullable();
            $table->string('address');
            $table->string('state')->nullable();
            $table->string('lat');
            $table->string('long');
            $table->boolean('is_branch')->default(0);
            $table->integer('branch_id')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('outlets');
    }
}
