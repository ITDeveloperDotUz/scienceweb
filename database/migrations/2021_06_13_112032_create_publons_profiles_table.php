<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublonsProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publons_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->longText('citations_per_year')->nullable();
            $table->longText('per_month_graph')->nullable();
            $table->longText('publication_stats')->nullable();
            $table->longText('per_year_graph')->nullable();
            $table->longText('institutions')->nullable();
            $table->longText('awards')->nullable();
            $table->longText('researchFields')->nullable();
            $table->string('publons_user_id', 30)->nullable();
            $table->string('publons_user_name')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('citations')->nullable();
            $table->integer('publications_count')->nullable();
            $table->integer('h_index')->nullable();
            $table->integer('average_per_year')->nullable();
            $table->integer('average_per_item')->nullable();
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
        Schema::dropIfExists('publons_profiles');
    }
}
