<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateTableUses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_uses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('table_id')->default(0)->index();
            $table->string('user_name')->nullable()->default(null);
            $table->string('user_phone')->nullable()->default(null);
            $table->dateTime('from_date')->nullable()->default(null);
            $table->dateTime('to_date')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_uses');
    }
}
