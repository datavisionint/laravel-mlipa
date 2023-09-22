<?php

use DatavisionInt\Mlipa\Enums\PayoutStatus;
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
        Schema::create('mlipa_payouts', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 100)->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('msisdn', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('receipt', 100)->nullable();
            $table->enum('status', PayoutStatus::values())->nullable()->default(PayoutStatus::AWAITING_VERIFICATION->value);
            $table->text("comment")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mlipa_payouts');
    }
};
