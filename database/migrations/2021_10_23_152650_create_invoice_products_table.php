<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_products', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('productCode');
            $table->string('productName');
            $table->double('productQuantity');
            $table->double('sellPrice');
            $table->double('totalSellprice');
            $table->double('discount');
            $table->double('buyPrice');
            $table->text('description');
            $table->string('discountType');
            $table->double('discountPercent');
            $table->double('discountFlat');
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
        Schema::dropIfExists('invoice_products');
    }
}
