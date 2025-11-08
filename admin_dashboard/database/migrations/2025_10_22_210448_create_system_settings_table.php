<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_title', 150)->nullable();
            $table->string('system_short_title', 100)->nullable();
            $table->string('logo', 255)->default('images/systems/logo/logo.png');
            $table->string('minilogo', 255)->default('images/systems/logo/minilogo.png');
            $table->string('favicon', 255)->default('images/systems/favicon/favico.png');
            $table->string('company_name', 150)->nullable();
            $table->string('tag_line', 255)->nullable();
            $table->string('phone_code', 5)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->string('email', 150)->nullable()->index();
            $table->string('time_zone', 50)->nullable();
            $table->string('language', 50)->nullable();
            $table->text('copyright_text')->nullable();
            $table->string('admin_title', 150)->nullable();
            $table->string('admin_short_title', 100)->nullable();
            $table->string('admin_logo', 255)->default('images/systems/logo/logo.png');
            $table->string('admin_mini_logo', 255)->default('images/systems/logo/minilogo.png');
            $table->string('admin_favicon', 255)->default('images/systems/favicon/favico.png');
            $table->text('admin_copyright_text')->nullable();
            $table->string('googlemap')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
