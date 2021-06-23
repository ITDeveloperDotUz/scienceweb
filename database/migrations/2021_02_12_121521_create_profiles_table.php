<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id');
            $table->string('public_name')->nullable();
            $table->string('swaid')->default(0);
            $table->string('orcid')->nullable();
            $table->string('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->string('work_org')->nullable();
            $table->string('work_dep')->nullable();
            $table->string('work_job')->nullable();
            $table->string('bio')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('keywords')->nullable();
            $table->text('social_links')->nullable();
            $table->integer('is_public')->nullable();
            $table->integer('h_index')->default(0);
            $table->integer('i10_index')->default(0);
            $table->integer('rating')->default(0);
            $table->date('birth_date')->nullable();
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
