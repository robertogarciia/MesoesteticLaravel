<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpgradesTable extends Migration
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
            //cosmeticos blau, medicamentos vermell, Sanitaria Verd, Control de calidad gris
            $table->enum('zone',['Cosmeticos','Medicamentos','Sanitaria','Control de calidad']);
            $table->enum('type', ['Maquinaria', 'Espacio', 'Material'])->default('Maquinaria');
            $table->string('worry');
            $table->string('benefit');
            $table->enum('state',['Valorandose','En curso','Resuelta'])->default('Valorandose');
            $table->integer('likes')->default(0);
            $table->boolean('like_pressed')->default(false);
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
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
}
