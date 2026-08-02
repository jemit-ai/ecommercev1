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
        Schema::disableForeignKeyConstraints();
        
        Schema::table('product_imports', function (Blueprint $table) {
            // 
            $table->foreignId('category_id')->after('filename')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('brand_id')->after('category_id')->nullable()->constrained()->nullOnDelete(); 

        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_imports', function (Blueprint $table) {
            //
        });
    }
};
