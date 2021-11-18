<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('notifer_id');
            $table->foreign('notifer_id')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('passive_user_id');
            $table->foreign('passive_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('passive_spot_id');
            $table->foreign('passive_spot_id')->references('id')->on('spots')->onDelete('cascade');
            $table->string('notice_type');
            $table->boolean('checked')->default(false);
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
        Schema::dropIfExists('notifications');
    }
}
