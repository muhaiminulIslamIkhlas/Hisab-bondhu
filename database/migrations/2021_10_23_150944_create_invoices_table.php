<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('user_number');
            $table->string('contact_id');
            $table->string('contact_name')->nullable();
            $table->text('contact_address')->nullable();
            $table->string('contact_number');
            $table->string('delivery_status');
            $table->string('invoice_date');
            $table->string('invoice_desc')->nullable();
            $table->string('delivery_partner_name')->nullable();
            $table->string('delivery_partner_code')->nullable();
            $table->double('service_charge')->nullable();
            $table->double('delivery_charge')->nullable();
            $table->double('total_payable');
            $table->double('vat')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
