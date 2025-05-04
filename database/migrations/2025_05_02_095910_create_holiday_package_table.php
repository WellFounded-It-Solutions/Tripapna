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
        Schema::create('holiday_package', function (Blueprint $table) {
            $table->id();
    $table->string('name');
    $table->string('email');
    $table->string('phone');
    $table->string('destination');
    $table->date('travel_date');
    $table->integer('duration');
    $table->integer('travelers');
    $table->decimal('budget', 10, 2);
    $table->text('preferences')->nullable();
    $table->string('passport_copy_path')->nullable();
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
        Schema::dropIfExists('holiday_package');
    }
};
