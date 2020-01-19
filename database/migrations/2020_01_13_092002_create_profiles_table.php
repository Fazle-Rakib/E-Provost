<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->integer('user_id')->unique();
            $table->bigInteger('reg_number')->nullable();
            $table->string('dept_name');
            $table->string('dept_post')->nullable();
            $table->string('hall_name');
            $table->string('hall_id')->nullable();
            $table->string('hall_post')->nullable();
            $table->string('profile_image');
            $table->string('blood_group');
            $table->string('phn_number');
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
        Schema::dropIfExists('profiles');
    }
}
