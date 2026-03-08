<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horses', function (Blueprint $table) {
            $table->id();
            $table->string('registered_name');
            $table->enum('sex', ['male', 'female'])->default('male');
            $table->date('birth_date')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'sold', 'retired'])->default('available');
            $table->string('photo_url')->nullable();
            $table->foreignId('breed_id')->nullable()->constrained('breeds')->nullOnDelete();
            $table->foreignId('stable_id')->nullable()->constrained('stables')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->comment('Current owner');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horses');
    }
};
