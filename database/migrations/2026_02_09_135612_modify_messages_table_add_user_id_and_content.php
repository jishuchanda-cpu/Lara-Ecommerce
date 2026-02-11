<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->renameColumn('message', 'content');
            $table->foreignId('user_id')->nullable()->after('id');
            $table->dropColumn(['name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->renameColumn('content', 'message');
            $table->string('name')->nullable()->after('id');
            $table->string('email')->nullable()->after('name');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
