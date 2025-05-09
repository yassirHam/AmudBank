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
            $table->enum('statut', ['actif', 'suspendu', 'fermé'])->default('actif');
            $table->date('date_ouverture');
            $table->timestamps(); // created_at et updated_at
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
