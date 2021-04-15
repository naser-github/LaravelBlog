<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            
            $table->unsignedBigInteger('user_fk');
            $table->foreign('user_fk')->references('id')->on('users');

            $table->unsignedBigInteger('user_role_fk');
            $table->foreign('user_role_fk')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign('profiles_user_fk_foreign');
            $table->dropColumn('user_fk');

            $table->dropForeign('profiles_user_role_fk_foreign');
            $table->dropColumn('user_role_fk');
        });
    }
}
