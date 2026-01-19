<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 * @license    GNU V2
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(
            'contacts',
            function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('email');
                $table->string('phone')->nullable();
                $table->string('subject')->nullable();
                $table->longText('message');
                $table->string('status', 15)->index()->default('new');
                $table->string('ip_address')->nullable();
                $table->string('user_agent')->nullable();
                $table->creator();
                $table->datetimes();
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
