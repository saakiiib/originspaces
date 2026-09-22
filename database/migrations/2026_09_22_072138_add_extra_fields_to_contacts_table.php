<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('postcode')->nullable()->after('phone');
            $table->string('topic')->nullable()->after('subject');
            $table->foreignId('product_id')->nullable()->after('topic')->constrained('products')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('product_id');
            $table->dropColumn(['postcode', 'topic']);
        });
    }
};
