<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractColumnsInClubsJoinedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clubs_joined', function (Blueprint $table) {
            $table->timestamp('contract_start')->nullable()->useCurrent();
            $table->timestamp('contract_end')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clubs_joined', function (Blueprint $table) {
            $table->dropColumn('contract_start');
            $table->dropColumn('contract_end');
        });
    }
}
