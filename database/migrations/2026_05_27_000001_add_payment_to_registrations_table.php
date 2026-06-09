<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->decimal('payment_amount', 12, 2)->nullable()->after('documents_verified');
            $table->string('payment_status')->default('unpaid')->after('payment_amount');
            $table->timestamp('paid_at')->nullable()->after('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['payment_amount', 'payment_status', 'paid_at']);
        });
    }
};
