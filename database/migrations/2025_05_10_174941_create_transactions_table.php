<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();  // transaction_id
            $table->foreignId('compte_id')->constrained('comptes')->onDelete('cascade');  
            $table->string('numero_compte');
            $table->string('compte_source');
            $table->decimal('montant', 10, 2);  // amount
            $table->enum('status',  ['en_attente', 'terminée', 'échouée'])->default('terminée'); 
            $table->enum('transaction_type', [
                'dépôt', 'retrait', 'paiement', 'virement',
                'remboursement', 'litige', 'frais', 'abonnement'])->default('virement');
            $table->text('description')->nullable();
            $table->string('nom_complete');
            $table->string('numero_compte_destination');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
