<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->longText('message');
            $table->string('status', 15)->index()->default('new');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->uuid('created_by_id')->nullable();
            $table->string('created_by_type')->nullable();
            $table->timestamps();

            $table->index(['created_by_id', 'created_by_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
