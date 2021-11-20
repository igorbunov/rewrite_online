<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSynonimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synonims', function (Blueprint $table) {
            $table->string('name')->unique();
            $table->longText('synonims');
        });

        $this->insertData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('synonims');
    }

    private function insertData()
    {
        DB::unprepared(file_get_contents(__DIR__ . '/import_synonims.sql'));
    }
}
