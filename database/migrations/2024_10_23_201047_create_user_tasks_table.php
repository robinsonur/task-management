<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {

        Schema::create('user_tasks', function (Blueprint $table) {
            $table
                ->foreignIdFor(\App\Models\Task::class)
                ->constrained()
                ->onDelete('cascade')
            ;
            $table
                ->foreignIdFor(\App\Models\User::class)
                ->constrained()
            ;
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['task_id', 'user_id']);
            $table->index(['task_id', 'user_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {

        Schema::dropIfExists('user_tasks');

    }

};
