<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteRolesAndWorkspacesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_type_id']);
            $table->dropColumn('user_type_id');
        });

        Schema::table('visitors', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropColumn('workspace_id');
        });

        Schema::table('workspace_api_keys', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropColumn('workspace_id');
        });

        Schema::drop('user_workspace');
        Schema::drop('roles');
        Schema::drop('user_types');
        Schema::drop('workspaces');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32)->unique();
            $table->string('title', 32);
        });

        Schema::create('user_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32)->unique();
            $table->string('title', 32);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_type_id')->after('id');

            $table->foreign('user_type_id')
                ->references('id')->on('user_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });

        Schema::create('workspaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 64);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_workspace', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('workspace_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('workspace_id')
                ->references('id')->on('workspaces')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });

        Schema::table('visitors', function (Blueprint $table) {
            $table->unsignedBigInteger('workspace_id')->after('uuid');

            $table->foreign('workspace_id')
                ->references('id')->on('workspaces')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });

        Schema::table('workspace_api_keys', function (Blueprint $table) {
            $table->unsignedBigInteger('workspace_id')->after('id');

            $table->foreign('workspace_id')
                ->references('id')->on('workspaces')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }
}
