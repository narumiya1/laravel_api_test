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
    // name, description, category, price, city, supplier
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->char('idnumber', 7);
            $table->string('fullname', 100);
            $table->enum('gender', ['M', 'F']);
            $table->string('address', 100);
            $table->char('phone', 20);
            $table->string('emailaddress', 120);
            $table->string('photo', 100);

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
        Schema::dropIfExists('products');
    }
};
