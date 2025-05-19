<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('Cin')->unique();
            $table->string('Role');
            $table->string('email')->unique();
            $table->string('telephone')->unique();
            $table->string('password');
            $table->string('cin_image'); 
            $table->date('birthday')->notNullable();
            $table->string('adresse')->notNullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
