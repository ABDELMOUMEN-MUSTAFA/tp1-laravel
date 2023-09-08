<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChambreUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chambre_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("chambre_id");
            $table->unsignedBigInteger("user_id");
            $table->date("date_depart");
            $table->date("date_arrivee");
            $table->timestamps();
            $table->foreign("chambre_id")->references("id")->on("chambres");
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chambre_user');
    }
}
