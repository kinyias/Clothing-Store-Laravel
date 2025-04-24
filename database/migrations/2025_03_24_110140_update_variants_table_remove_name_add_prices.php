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
        Schema::table('variants', function (Blueprint $table) {
            $table->dropColumn('name'); // Xóa trường name
            $table->decimal('regular_price', 12, 3)->nullable(); // Thêm regular_price
            $table->decimal('sale_price', 12, 3)->nullable();   // Thêm sale_price
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->string('name')->nullable(); // Khôi phục name nếu rollback
            $table->dropColumn(['regular_price', 'sale_price']); // Xóa regular_price và sale_price
        });
    }
};
