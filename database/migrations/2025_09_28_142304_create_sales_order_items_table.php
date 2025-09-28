<?php

use App\Models\SalesOrder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SalesOrder::class)->constrained();
            $table->string('name');
            $table->string('short_desc');
            $table->string('sku');
            $table->string('slug');
            $table->string('description');
            $table->text('desription')->nullable();
            $table->string('cover_url')->nullable();
            $table->integer('quantity');
            $table->double('price', 11, 2);
            $table->double('total', 11, 2);
            $table->integer('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_items');
    }
};
