<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    private $schema = 'dbo';
    private $name = 'statuses';

    /**
     * Run the migrations.
     */
    public function up(): void {

        DB::statement("DROP VIEW IF EXISTS $this->name");

        DB::statement("
            CREATE VIEW $this->name AS SELECT
                r.record_type_id,
                r.id AS record_id,
                ROW_NUMBER() OVER (ORDER BY r.id) AS id,
                r.name,
                r.deleted_at,
                r.created_at,
                r.updated_at
                FROM records AS r
                INNER JOIN record_types AS rt
                    ON r.record_type_id = rt.id
                WHERE rt.name = '" . ucfirst($this->name) . "'
                ORDER BY r.id
        ");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {

        // Issues: Doesn't work well for views
        // DB::statement("DROP VIEW IF EXISTS $this->name");

    }

};
