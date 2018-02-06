<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('email');
            $table->string('unique_id', 20);
            $table->string('password');
            $table->string('password_salt', 20);
            $table->boolean('is_admin')->default(0);
            $table->string('email_verify_token')->nullable()->default(null);
            $table->boolean('is_verified')->default(0);
            $table->boolean('status')->default(1);
            $table->string('reset_password_token')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
