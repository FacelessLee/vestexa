<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBanSystemToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_banned')->default(false)->after('status');
            $table->text('ban_message')->nullable()->after('is_banned');
            $table->timestamp('banned_at')->nullable()->after('ban_message');
            $table->timestamp('ban_expires_at')->nullable()->after('banned_at');
            $table->string('banned_by')->nullable()->after('ban_expires_at'); // Admin who banned the user
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
            $table->dropColumn([
                'is_banned',
                'ban_message',
                'banned_at',
                'ban_expires_at',
                'banned_by'
            ]);
        });
    }
}
