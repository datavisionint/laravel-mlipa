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
        Schema::create('mlipa_request_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->enum('type', MlipaApiRequestLogType::values())->nullable()->default(MlipaApiRequestLogType::API_CALL->value);
            $table->string('reference', 1024)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('method', 100)->nullable();
            $table->json('headers')->nullable();
            $table->string('token', 2048)->nullable();
            $table->json('body')->nullable();
            $table->string('response_status', 100)->nullable();
            $table->json('response')->nullable();
            $table->json('other_details')->nullable();
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
