<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();

            $table
                ->foreignId('country_id')
                ->references('id')
                ->on('countries');

            $table->boolean('is_active')->default(true);
        });

        $countries_seeder = new \Database\Seeders\CountriesStatesSeeder();
        $countries_seeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
