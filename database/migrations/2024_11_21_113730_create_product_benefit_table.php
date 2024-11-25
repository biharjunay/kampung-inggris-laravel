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
        Schema::create('product_benefit', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained("products")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("benefit_id")->constrained("benefits")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_benefit');
    }
};
