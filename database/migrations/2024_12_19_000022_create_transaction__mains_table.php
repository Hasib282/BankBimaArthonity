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
        Schema::connection('mysql_second')->create('transaction__mains', function (Blueprint $table) {
            $table->id();
            $table->string('tran_id')->unique();
            $table->bigInteger('tran_type')->comment('transaction__main__heads');
            $table->string('tran_method');
            $table->string('invoice')->nullable();
            $table->bigInteger('loc_id')->nullable()->comment('location__infos');
            $table->unsignedBigInteger('tran_type_with')->nullable();
            $table->string('tran_bank')->nullable();
            $table->string('tran_user')->nullable();
            $table->string('ptn_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_address')->nullable();
            $table->float('bill_amount')->nullable();
            $table->float('discount')->default('0');
            $table->float('net_amount')->nullable();
            $table->float('receive')->nullable();
            $table->float('payment')->nullable();
            $table->float('due')->nullable();
            $table->float('due_col')->default(0)->nullable();
            $table->float('due_disc')->default(0)->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('payment_mode')->nullable();
            $table->text('note')->nullable();
            $table->string('booking_id')->nullable();
            $table->timestamp('tran_date')->useCurrent();
            $table->tinyInteger('status')->default('1')->comment('1 for Active 0 for Inactive');
            $table->timestamp('updated_at')->nullable();
            
            // Foreignkey Decleration
            $table->foreign('tran_type_with')->references('id')->on('transaction__withs')
                    ->onUpdate('cascade');
            // $table->foreign('tran_user')->references('user_id')->on('user__infos')
            //         ->onUpdate('cascade');
            $table->foreign('store_id')->references('id')->on('stores')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql_second')->dropIfExists('transaction__mains');
    }
};
