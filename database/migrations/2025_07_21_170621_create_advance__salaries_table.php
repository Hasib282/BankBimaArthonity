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
        Schema::connection('mysql_second')->create('advance__salaries', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->float('amount');
            $table->json('months');
            $table->integer('start_month');
            $table->text('reason')->nullable();
            $table->string('repayment_method')->comment('Full / Installment');
            $table->float('installment_amount')->nullable();
            $table->string('due');
            $table->tinyInteger('status')->default('1');
            $table->string('approved_by')->nullable();
            $table->string('tran_id')->nullable();
            $table->timestamp('payment_date');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql_second')->dropIfExists('advance__salaries');
    }
};
