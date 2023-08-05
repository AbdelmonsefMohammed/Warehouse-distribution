<?php

declare(strict_type=1);

use App\Enums\Role;
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
        Schema::create('members', static function (Blueprint $table) : void {
            $table->ulid('id')->primary();
            $table->string('role')->default(Role::USER->value);
            $table->foreignUlid('client_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignUlid('company_id')->index()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
