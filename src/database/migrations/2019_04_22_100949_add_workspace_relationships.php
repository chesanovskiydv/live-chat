<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkspaceRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropColumn('workspace_id');
        });

        Schema::table('workspace_api_keys', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropColumn('workspace_id');
        });
    }
}
