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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->dateTime('deleted_at')->nullable();

            // adding index and foreign key
            $table->index('product_id', 'inventories_index_1');
            $table->foreign('product_id')->references('id')->on('products');

            $table->index('customer_id', 'inventories_index_2');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // remove the index and foreign first before dropping
        Schema::table('inventories', function (Blueprint $table) {
            // penamaan foreign 'nama_table' + 'nama_kolom' + '_foreign'
            $table->dropForeign(['product_id']);
            $table->dropForeign(['customer_id']);
            $table->dropIndex('inventories_index_1');
            $table->dropIndex('inventories_index_2');
        });

        Schema::dropIfExists('inventories');
    }
};
