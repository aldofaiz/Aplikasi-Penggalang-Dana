<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('organization_name')->nullable();
            $table->string('organization_logo')->nullable();
            $table->string('PIC')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('rekening_number')->nullable();
            $table->string('rekening_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->enum('organization_status', ['active', 'pending', 'nonactive', 'blacklist'])->default('pending');
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
        Schema::dropIfExists('organizations');
    }
}
