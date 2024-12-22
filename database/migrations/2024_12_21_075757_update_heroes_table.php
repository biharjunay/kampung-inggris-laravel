<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->string('image_url')->nullable()->change();
            $table->string('value')->nullable();
            $table->string('redirect_to')->nullable();
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->string('image_url')->nullable(false)->change();
            $table->dropColumn('value');
            $table->dropColumn('redirect_to');
            $table->dropColumn('description');
        });
    }
};
