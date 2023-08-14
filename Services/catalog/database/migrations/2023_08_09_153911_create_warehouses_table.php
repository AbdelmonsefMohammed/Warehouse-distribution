<?php

declare(strict_types=1);

use App\Enums\WarehouseStatus;
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
        Schema::create('warehouses', static function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('manager');
            $table->string('email')->unique();
            $table->string('status')->default(WarehouseStatus::ONLINE->value);
            $table->json('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
