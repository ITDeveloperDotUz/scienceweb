<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcidTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcid_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('access_token');
            $table->string('token_type');
            $table->string('refresh_token');
            $table->integer('expires_in');
            $table->string('scope');
            $table->string('name');
            $table->string('orcid');
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
        Schema::dropIfExists('orcid_tokens');
    }
}
