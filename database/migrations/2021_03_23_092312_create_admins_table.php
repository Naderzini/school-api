<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Admin;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->longText('device_token')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('phone');
            $table->tinyInteger('role')->default(2);
            $table->timestamps();
        });

        $admin = new Admin();
        $admin-> first_name = 'admin';
        $admin-> last_name = 'admin';
        $admin-> device_token = null;
        $admin-> email = 'superadmin@gmail.com';
        $admin-> password = bcrypt('azerty');
        $admin-> phone = '(+216) 71600600';
        $admin-> role = 1;
        $admin-> photo = null;
        $admin->save();
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
