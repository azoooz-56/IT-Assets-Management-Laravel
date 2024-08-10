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
        Schema::create('it_asset', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('serial_number')->unique();
            $table->date('warranty_expiration_date');
            $table->enum('status', ['New', 'In Use', 'Damaged', 'Dispose']);
            $table->timestamps(); // This will add created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('it_asset');
    }
};
