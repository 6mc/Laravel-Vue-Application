<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('fax');
            $table->string('email');
            $table->string('website');
            $table->string('adress');
            $table->string('directions');
            $table->string('vizyon');
            $table->string('misyon');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('promo');
            $table->string('workstart_hour');
            $table->string('workend_hour');
            $table->string('tags');
            $table->string('fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
