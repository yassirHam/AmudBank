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
    Schema::create('cartes_bancaires', function (Blueprint $table) {
        $table->id(); // id primaire auto-incrémenté
        $table->foreignId('compte_id')->constrained('comptes')->onDelete('cascade'); // lien avec un compte
        $table->string('numero_compte')->unique(); // numéro visible pour transfert, unique
        $table->string('numero_carte'); // 16 chiffres typiquement
        $table->enum('type_carte', ['Visa', 'MasterCard', 'Autre']);
        $table->date('date_expiration');
        $table->string('code_securite'); // CVV (crypté dans la vraie vie)
        $table->enum('etat', ['active', 'bloquée', 'expirée'])->default('active');
        $table->date('date_creation');
        $table->timestamps(); // created_at et updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartes_bancaires');
    }
};
