<?php

  use Illuminate\Support\Facades\Schema;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;

  class CreateSyncadInstancesTable extends Migration
  {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('syncad_instances', function (Blueprint $table) {
        $table->increments('id');
        $table->string('type')->default('user');
        $table->string('syncad_token');
        $table->string('syncad_key')->nullable();
        $table->unsignedInteger('user_id');
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
      Schema::dropIfExists('syncad_instances');
    }
  }
