<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('category')->nullable()->after('slug');
            $table->integer('max_person')->nullable()->after('duration_minutes');
            $table->json('bonus')->nullable()->after('max_person');
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['category', 'max_person', 'bonus']);
        });
    }
};
