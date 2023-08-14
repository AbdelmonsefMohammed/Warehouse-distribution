<?php

declare(strict_types=1);

use App\Enums\ProductStatus;
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
        Schema::create('products', static function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->string('name');
            $able->string('status')->default(ProductStatus::IN_STOCK->value);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('cost')->default(0);
            $table->unsignedBigInteger('weight')->default(0);
            $table->unsignedBigInteger('stock')->default(0);
            $table->json('dimensions')->nullable();
            $table->foreignUlid('category_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->foreignUlid('supplier_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->foreignUlid('warehouse_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
