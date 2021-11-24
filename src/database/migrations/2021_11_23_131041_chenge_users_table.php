<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChengeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->enum('provider', ['google', 'twitter'])->nullable();
            $table->string('provided_user_id')->nullable();
            $table->unique(['provider', 'provided_user_id']);
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
            $table->string('token')->nullable();
            $table->dropUnique(['provider', 'provided_user_id']);
            $table->dropColumn('provider'); 
            $table->dropColumn('provided_user_id');
        });
    }
}
