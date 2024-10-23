<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {

        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(\App\Models\RecordType::class)
                ->constrained()
                ->onDelete('cascade')
            ;
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['record_type_id', 'name']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {

        Schema::dropIfExists('records');

    }

};
