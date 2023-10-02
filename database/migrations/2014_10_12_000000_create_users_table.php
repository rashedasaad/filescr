<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 30);
            $table->string('name');
            $table->string('nickname');
            $table->string('email')->unique();
            $table->string('avatar',150)->default(null);
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_ban')->default(0);
            $table->string('customer_id',40);
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
        Schema::dropIfExists('users');
    }
};
