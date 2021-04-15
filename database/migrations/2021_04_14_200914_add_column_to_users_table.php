<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->unsignedBigInteger('profile_fk');
            $table->foreign('profile_fk')->references('id')->on('profiles');

            $table->unsignedBigInteger('role_fk');
            $table->foreign('role_fk')->references('id')->on('roles');
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
            $table->dropForeign('users_profile_fk_foreign');
            $table->dropColumn('profile_fk');
            
            $table->dropForeign('users_role_fk_foreign');
            $table->dropColumn('role_fk');
        });
    }
}
