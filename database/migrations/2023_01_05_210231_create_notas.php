<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 50);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('notas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('usuario_id')->constrained('usuario')->onDelete('CASCADE');
            $table->string('titulo', 50);
            $table->string('cuerpo', 150);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
};
