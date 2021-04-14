<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type');
            $table->string('tin', 9);
            $table->string('country_code');
            $table->string('state');
            $table->string('postal_code', 10)->nullable();
            $table->string('address', 250);
            $table->string('email');
            $table->string('preferred_locale');
            $table->string('phone');
            $table->string('affiliate_person');
            $table->string('bank_account', 30)->nullable();
            $table->string('bank_code', 10)->nullable();
            $table->string('bank_name', 150)->nullable();
            $table->string('password');
            $table->string('website')->nullable();
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
        Schema::dropIfExists('publishers');
    }
}
