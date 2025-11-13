<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 0);
            $table->enum('status', ['available', 'in_progress', 'unavailable'])->default('available');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image')->nullable();
            $table->string('link_drive')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

