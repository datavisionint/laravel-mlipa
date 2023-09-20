<?php

use DatavisionInt\Mlipa\Enums\MlipaApiRequestLogType;
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
        Schema::create('mlipa_webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 100)->nullable();
            $table->string('method', 100)->nullable();
            $table->string('url', 100)->nullable();
            $table->json('request_headers')->nullable();
            $table->json('response_headers')->nullable();
            $table->json('request_body')->nullable();
            $table->json('response_body')->nullable();
            $table->string('response_status_code', 100)->nullable();
            $table->string('request_duration', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mlipa_request_logs');
    }
};
