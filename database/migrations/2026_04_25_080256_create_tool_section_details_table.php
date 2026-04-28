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
        Schema::create('tool_section_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tool_section_id');
            $table->unsignedBigInteger('expense_id');
            $table->foreign('tool_section_id')->references('id')->on('tool_sections');
            $table->foreign('expense_id')->references('id')->on('expenditures');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_section_details');
    }
};
