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
        Schema::create('comptes', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type_compte', ['courant', 'epargne', 'professionnel']);
            $table->decimal('solde', 15, 2)->default(0);
            $table->enum('statut', ['actif', 'suspendu', 'fermé','expirée'])->default('actif');
            $table->string('numero_compte')->unique(); 
            $table->string('numero_carte')->unique();
            $table->string('rip')->unique();
            $table->string('Code_guichet');
            $table->enum('type_carte', ['Visa', 'MasterCard', 'Autre']);
            $table->string('date_expiration');
            $table->string('code_securite'); 
            $table->decimal('plafond_journalier', 10, 2); 
            $table->timestamps(); 
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
