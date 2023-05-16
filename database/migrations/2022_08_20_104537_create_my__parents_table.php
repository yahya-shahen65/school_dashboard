<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my__parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('pass');

            // father
            $table->json('name_father');
            $table->string('national_id_father');
            $table->string('passport_id_father');
            $table->string('phone_father');
            $table->json('job_father');
            $table->string('address_father');
            $table->foreignId('nationality_father_id');
            $table->foreignId('blod_type_father_id');
            $table->foreignId('religion_father_id');

            // mother
            $table->json('name_mother');
            $table->string('national_id_mother');
            $table->string('passport_id_mother');
            $table->string('phone_mother');
            $table->json('job_mother');
            $table->string('address_mother');
            $table->foreignId('nationality_mother_id');
            $table->foreignId('blod_type_mother_id');
            $table->foreignId('religion_mother_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my__parents');
    }
};
