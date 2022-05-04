<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
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
            $table->foreignId('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('program_title');
            $table->date('program_deadline')->nullable();
            $table->text('program_description')->nullable();
            $table->string('program_collected_funds')->nullable();
            $table->string('program_proposal_file')->nullable();
            $table->string('program_report_file')->nullable();
            $table->json('program_photo')->nullable();
            $table->enum('program_status', ['published','draft','finished'])->default('draft');
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
}
