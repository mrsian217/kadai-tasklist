<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return n class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("tasks",function(Blueprint $table){
            $table->string("status",10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    
   public function up()
    {
        Schema::table("tasks", function (Blueprint $table) {
            $table->string("status", 10);
        });
    }