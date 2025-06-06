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
        Schema::table('categorias', function (Blueprint $table) {
            $table->boolean('destacado')->default(0)->after('path');
        });

        Schema::table('marcas', function (Blueprint $table) {
            $table->boolean('destacado')->default(0)->after('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            //
        });
        
        Schema::table('marcas', function (Blueprint $table) {
            //
        });
    }
};
