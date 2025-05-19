<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('montant', 12, 2);
            $table->string('type');
            $table->integer('duree');
            $table->string('motif_credit');
            $table->string('compte_bancaire');
            $table->string('revenu_mensuel');
            $table->string('Attestation_travail_contrat');
            $table->string('Bulletins_salaire');
            $table->decimal('paiement_mensuel', 10, 2);
            $table->enum('statut', ['en_attente', 'approuve', 'rejete', 'actif', 'termine'])->default('en_attente');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('credits');
    }
};