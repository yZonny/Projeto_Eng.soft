<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id('id');
            $table->string('nome',100);
            $table->integer('idade');
            $table->string('cpf',11);
            $table->string('endereco',100);
            $table->string('telefone',20);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('worker');
    }
};
