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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->unsignedBigInteger('document_id')->index();
            $table->timestamps();
            $table->foreign('document_id')
                    ->references('id')
                    ->on('documents')
                    ->onDelete('cascade');
        });

        // Pevot Table

        // Schema::create('attachment_document', function (Blueprint $table) {

        //     $table->integer('document_id')->unsigned();
        
        //     $table->integer('attachment_id')->unsigned();
        
        //     $table->foreign('document_id')->references('id')->on('documents')
        
        //         ->onDelete('cascade');
        
        //     $table->foreign('attachment_id')->references('id')->on('attachments')
        
        //         ->onDelete('cascade');
        
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
        // Schema::dropIfExists('attachment_document');
    }
};
