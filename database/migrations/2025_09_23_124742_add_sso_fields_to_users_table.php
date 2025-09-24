<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_sso_fields_to_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('keycloak_id')->nullable()->unique()->after('id');
            $table->string('avatar')->nullable()->after('email');
            $table->json('kc_payload')->nullable()->after('avatar'); // opsional: payload mentah
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['keycloak_id','avatar','kc_payload']);
        });
    }
};
