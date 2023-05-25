<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('category_ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('category_id')->unsigned();
            $table->foreignId('ticket_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_ticket');
    }
};
