<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Name', 70);
            $table->string('Short_Name', 50);
            $table->string('Vertical', 50);
            $table->text('Address');
            $table->string('Logo', 80);
            $table->string('Center_Suffix', 20)->nullable();
            $table->string('ID_Suffix', 10)->nullable();
            $table->string('Api_Key', 60)->nullable();
            $table->tinyInteger('Is_Vocational')->default(0);
            $table->tinyInteger('Is_B2C')->default(0);
            $table->tinyInteger('Has_LMS')->default(0);
            $table->tinyInteger('Has_Unique_Center')->default(0);
            $table->tinyInteger('Has_Unique_StudentID')->default(0);
            $table->tinyInteger('Status')->default(1);
            $table->integer('Max_Character')->default(255);
            $table->integer('Created_By')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
