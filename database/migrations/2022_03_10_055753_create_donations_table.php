<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->references('id')->on('donors')->onDelete('cascade');
            $table->foreignId('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->string('donation_code');
            $table->decimal('amount', 20, 2)->nullable()->default(0);
            $table->string('note')->nullable();
            $table->integer('alias')->nullable()->default(0);
            $table->string('snap_token')->nullable();
            $table->enum('donation_status', ['pending','success','failed','expired'])->default('pending');
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
        Schema::dropIfExists('donations');
    }
}
