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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->boolean('isOpenDoor')->default(false);
            $table->integer('speed')->default(0);
            $table->integer('odometer')->default(0);
            $table->unsignedTinyInteger('leftWindow')->default(100);
            $table->unsignedTinyInteger('rightWindow')->default(100);
            $table->string('entertainment_Unit')->default('radio');
            $table->boolean('statement_car')->default('stop');
            $table->float('fuel')->default(0.2);
            $table->boolean('isTurn')->default(false);
            $table->foreignIdFor(\App\Models\User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
