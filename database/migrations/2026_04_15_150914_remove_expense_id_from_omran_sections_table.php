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
        Schema::table('omran_sections', function (Blueprint $table) {
            $table->dropForeign('omran_sections_expense_id_foreign');
            $table->dropColumn('expense_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('omran_sections', function (Blueprint $table) {
            //
        });
    }
};
