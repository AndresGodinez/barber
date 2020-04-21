<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');

            $table->string('last_name');

            $table->string('email');

            $table->string('telephone');

            $table->date('expiration');

            $table->integer('branch_limit')->default(4);
            $table->integer('user_limit')->default(12);

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
                ->references('id')->on('types');

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
        Schema::dropIfExists('customers');
    }
}
