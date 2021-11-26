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
            $table->string('author')->nullable();
            $table->unsignedInteger('image_id')->nullable();
            $table->text('topic')->nullable();
            $table->boolean('vip')->nullable()->default(0);
            $table->string('started_at')->nullable();
            $table->string('finished_at')->nullable();
            $table->timestamps();

            $table->foreign('image_id')
                ->references('id')
                ->on('attachments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
