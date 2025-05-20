<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('comptes', function (Blueprint $table) {
        $table->renameColumn('Code_guichet', 'CVV_CVC');
    });
}

public function down()
{
    Schema::table('comptes', function (Blueprint $table) {
        $table->renameColumn('CVV_CVC', 'Code_guichet');
    });
}

};
