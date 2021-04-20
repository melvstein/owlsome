<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('accountId')->unique();
            $table->string('role')->default('Customer');
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('contactNumber')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('address');
            $table->string('city')->default('Muntinlupa City');
            $table->string('password');
            $table->text('profile_photo_path')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('status')->default('Active');
            $table->timestamp('last_seen')->nullable();
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
        Schema::dropIfExists('users');
    }
}
