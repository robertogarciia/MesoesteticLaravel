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
        Schema::create('upgrades', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->integer('zone');
            $table->enum('type', ['Maquinaria', 'Espacio', 'Material'])->default('Maquinaria');
            $table->string('worry');
            $table->string('benefit');
            $table->string('state');
            $table->integer('like');
            $table->unsignedBigInteger("users_id");
            $table->foreign("users_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");
            $table->unsignedBigInteger("admin_id");
            $table->foreign("admin_id")
                ->references("id")
                ->on("admins")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upgrades');
    }
};
