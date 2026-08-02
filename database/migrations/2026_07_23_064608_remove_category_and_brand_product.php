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
        // Disable foreign key checks and drop columns safely
        Schema::disableForeignKeyConstraints();

        Schema::table('products', function (Blueprint $table) {

           /* $table->dropForeign(['category_id']);
            $table->dropForeign(['brand_id']);

            $table->dropColumn(['category_id', 'brand_id']);*/
        });
        Schema::enableForeignKeyConstraints();
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
