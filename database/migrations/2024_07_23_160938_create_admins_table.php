<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Name of the admin
            $table->string('prenom');  // First name (prenom)
            $table->integer('age');  // Age of the admin
            $table->date('date_of_birth');  // Date of birth
            $table->string('cin')->unique();  // CIN (unique identifier)
            $table->string('email')->unique();  // Email address (unique)
            $table->string('password');  // Password
            $table->string('image')->nullable();  // Profile image (nullable)
            $table->enum('role', ['super_admin', 'admin']);  // Role of the admin
            $table->rememberToken();  // Token for remember me functionality
            $table->timestamps();  // Created_at and updated_at timestamps
            $table->softDeletes();  // For soft deletes
        });

        // Insert a test admin
        DB::table('admins')->insert([
            'name' => 'John',  // Admin's name
            'prenom' => 'Doe',  // Admin's first name
            'age' => 30,  // Admin's age
            'date_of_birth' => '1993-07-23',  // Admin's date of birth
            'cin' => 'AB123456',  // Admin's CIN
            'email' => 'john.doe@example.com',  // Admin's email
            'password' => Hash::make('password123'),  // Admin's password (hashed)
            'image' => null,  // No image for this test admin
            'role' => 'admin',  // Admin's role
            'created_at' => now(),  // Timestamp of creation
            'updated_at' => now(),  // Timestamp of last update
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};