<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('student_id');
            $table->enum('status', ['sent', 'success'])->nullable();
            $table->datetime('sent_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_students');
    }
}
