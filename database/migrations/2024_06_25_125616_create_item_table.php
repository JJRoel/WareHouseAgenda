<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
{
    public function up()
    {
        Schema::create('item_id', function (Blueprint $table) {
            $table->id();
            $table->foreignId('groupid')->constrained('group');
            $table->string('name');
            $table->string('aanschafdatum');
            $table->string('tiernummer');
            $table->string('status');
            $table->binary('picture')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_id');
    }
}

