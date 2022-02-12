<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->integer("hushtag_id");
            $table->integer("instagram_id")->nullable();
            $table->string("media_url", 500)->nullable();
            $table->string("permalink", 500)->nullable();
            $table->string("caption", 2200)->nullable();
            $table->timestamp("updated_at");
            $table->timestamp("created_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributions');
    }
}
