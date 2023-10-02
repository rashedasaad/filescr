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
        Schema::create('actives', function (Blueprint $table) {
            $table->id();
            $table->integer("script_id");
            $table->string('user_id');
            $table->string('script_name', 50);
            $table->string('server_name', 50);
            $table->string('discord_id', 30);
            $table->ipAddress("ip_server");
            $table->string('script_token', 100)->unique();
            $table->string('script_licens', 50);
            $table->boolean('script_status')->default(0);
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
        Schema::dropIfExists('actives');
    }
};
