<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransferLimitsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('min_transfer_amount', 15, 2)->default(1.00)->after('account_bal');
            $table->decimal('max_transfer_amount', 15, 2)->default(500000.00)->after('min_transfer_amount');
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
            $table->dropColumn(['min_transfer_amount', 'max_transfer_amount']);
        });
    }
}
