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
        Schema::table('omran_employees', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->after('omran_field_id');
            $table->foreign('employee_id')->references('id')->on('employees');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('omran_employees', function (Blueprint $table) {
            //
        });
    }
};
