<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('section_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('doi')->nullable();
            $table->integer('status')->default(1);
            $table->string('locale');
            $table->text('citations')->nullable();
            $table->string('file');
            $table->string('preview')->nullable();
            $table->string('thumb')->nullable();
            $table->string('rights')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('submissions');
    }
}
