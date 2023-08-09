<?php

declare(strict_type=1);

use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', static function (Blueprint $table) : void {
            $table->ulid('id')->primary();
            $table->string('status')->default(OrderStatus::DRAFT->value);
            $table->unsignedBigInteger('weight')->default(0);
            $table->json('shipping')->nullable();
            $table->json('billing')->nullable();
            $table->foreignUlid('client_id')->index()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
