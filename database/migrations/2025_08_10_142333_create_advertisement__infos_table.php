<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::connection('mysql_second')->create('advertisement__infos', function (Blueprint $table) {
            $table->id();
            $table->string('tran_id')->nullable();
            $table->date('publication_date')->nullable();
            $table->string("client_id")->nullable();
            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->string('category')->nullable();
            $table->string('page_no')->nullable();
            $table->string('column_inch')->nullable();
            $table->string('document')->nullable();
            $table->string('type')->nullable();
            $table->string('discount')->nullable();

            $table->timestamp('added_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::connection('mysql_second')->dropIfExists('advertisement__infos');
    }
};
