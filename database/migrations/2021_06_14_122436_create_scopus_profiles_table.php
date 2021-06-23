<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScopusProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scopus_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('orcid')->nullable();
            $table->string('institution')->nullable();
            $table->integer('h_index')->nullable();
            $table->string('email')->nullable();
            $table->integer('documents_count')->nullable();
            $table->integer('co_authors')->nullable();
            $table->integer('cited_by_count')->nullable();
            $table->integer('citations_count')->nullable();
            $table->string('author_id', 30)->nullable();
            $table->longText('subject_areas')->nullable();
            $table->longText('chart')->nullable();
            $table->longText('publications')->nullable();

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
        Schema::dropIfExists('scopus_profiles');
    }
}
