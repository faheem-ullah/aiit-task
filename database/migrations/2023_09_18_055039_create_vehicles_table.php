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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('model');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('mileage');
            $table->enum('transmission',['manual','automatic'])->default('manual');
            $table->decimal('price', 10, 2);
            $table->text('images',1000)->nullable();
            $table->enum('status',['active','sold'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
