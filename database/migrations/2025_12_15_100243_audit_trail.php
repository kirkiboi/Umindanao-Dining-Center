<?php

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
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 50);
            $table->enum('action_type', ['item_added', 'price_updated', 'item_deleted']);
            $table->unsignedBigInteger('user_id');
            $table->decimal('previous_price', 10, 2)->nullable();
            $table->decimal('new_price', 10, 2)->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_trails');
    }
};