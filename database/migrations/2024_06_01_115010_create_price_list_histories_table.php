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
        Schema::create('price_list_histories', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 18, 3);
            $table->unsignedBigInteger('price_list_id');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->dateTime('deleted_at')->nullable();

            // adding index and foreign key
            $table->index('price_list_id', 'price_list_histories_index_1');
            $table->foreign('price_list_id')->references('id')->on('price_lists');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        // remove the index and foreign first before dropping
        Schema::table('price_list_histories', function (Blueprint $table) {
            // penamaan foreign 'nama_table' + 'nama_kolom' + '_foreign'
            $table->dropForeign(['price_list_id']);
            $table->dropIndex('price_list_histories_index_1');
        });

        Schema::dropIfExists('price_list_histories');
    }
};
