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
        Schema::create('price_lists', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 18, 3);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->dateTime('deleted_at')->nullable();

            // adding index and foreign key
            $table->index('product_id', 'price_list_index_1');
            $table->foreign('product_id')->references('id')->on('products');

            $table->index('customer_id', 'price_list_index_2');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // remove the index and foreign first before dropping
        Schema::table('price_lists', function (Blueprint $table) {
            // penamaan foreign 'nama_table' + 'nama_kolom' + '_foreign'
            $table->dropForeign(['product_id']);
            $table->dropForeign(['customer_id']);
            $table->dropIndex('price_list_index_1');
            $table->dropIndex('price_list_index_2');
        });

        Schema::dropIfExists('price_lists');
    }
};
