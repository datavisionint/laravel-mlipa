<?php

use DatavisionInt\Mlipa\Enums\CollectionStatus;
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
        Schema::create('mlipa_collections', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('msisdn', 100)->nullable();
            $table->string("billing_page_url", 256)->nullable();
            $table->string("nonce", 256)->nullable();
            $table->string("currency", 256)->nullable();
            $table->string("expires_at", 256)->nullable();
            $table->string('reference', 100)->nullable();
            $table->string('receipt')->nullable();
            $table->enum('status', CollectionStatus::values())->nullable()->default(CollectionStatus::PENDING);
            $table->text("comment")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mlipa_collections');
    }
};
