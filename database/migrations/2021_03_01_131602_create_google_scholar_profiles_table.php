<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleScholarProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_scholar_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('citations')->nullable();
            $table->integer('citations_five_year')->nullable();
            $table->integer('h_index')->nullable();
            $table->integer('h_index_five_year')->nullable();
            $table->integer('i10_index')->nullable();
            $table->integer('i10_index_five_year')->nullable();
            $table->text('by_year')->nullable();
            $table->string('gs_user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('organization')->nullable();
            $table->string('domain')->nullable();
            $table->text('interests')->nullable();
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
        Schema::dropIfExists('google_scholar_profiles');
    }
}
