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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->decimal('purchasing_price', 18, 3);
            $table->unsignedBigInteger('supplier_id');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->dateTime('deleted_at')->nullable();

            // adding index and foreign key
            $table->index('product_id', 'purchase_index_1');
            $table->foreign('product_id')->references('id')->on('products');

            $table->index('supplier_id', 'purchase_index_2');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // remove the index and foreign first before dropping
        Schema::table('purchases', function (Blueprint $table) {
            // penamaan foreign 'nama_table' + 'nama_kolom' + '_foreign'
            $table->dropForeign(['product_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropIndex('purchase_index_1');
            $table->dropIndex('purchase_index_2');
        });

        Schema::dropIfExists('purchases');
    }
};
