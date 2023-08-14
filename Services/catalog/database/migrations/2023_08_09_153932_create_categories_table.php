<?php

declare(strict_types=1);

use App\Enums\CategoryStatus;
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
        Schema::create('categories', static function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('status')->default(CategoryStatus::ACTIVE->value);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
