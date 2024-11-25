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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_id')->constrained('product_types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->integer('total_student')->nullable();
            $table->string('review')->nullable();
            $table->integer('total_minute')->nullable();
            $table->decimal('price', 15, 0);
            $table->decimal('discount_price', 15, 0)->nullable();
            $table->tinyInteger('discount_percentage')->nullable();
            $table->date('due_date')->nullable();
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
        Schema::dropIfExists('programs');
    }
};
