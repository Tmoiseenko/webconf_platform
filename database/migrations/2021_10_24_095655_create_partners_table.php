<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('about')->nullable();
            $table->string('link')->nullable();
            $table->unsignedInteger('image_id')->nullable();
            $table->string('status_id', 50)->nullable();
            $table->integer('order')->nullable()->default(0);
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
        Schema::dropIfExists('partners');
    }
}
