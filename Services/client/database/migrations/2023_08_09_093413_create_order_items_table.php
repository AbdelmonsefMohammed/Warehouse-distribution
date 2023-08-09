<?php

declare(strict_type=1);

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
        Schema::create('order_items', static function (Blueprint $table) : void {
            $table->ulid('id')->primary();
            $table->string('product');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('discount')->default(0)->comment('Stored as percentage');
            $table->foreignUlid('order_id')->index()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
