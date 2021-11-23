<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\CildParent;
class CreateChildparentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_parents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('cin')->unique();
            $table->string('device_token')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->string('postal_code');
            $table->string('government');
            $table->string('occupation');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('genre');
            $table->string('photo')->nullable();
            $table->string("phone");
            $table->rememberToken();
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
        Schema::dropIfExists('child_parents');
    }
}
