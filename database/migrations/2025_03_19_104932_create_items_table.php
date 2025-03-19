<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id('id_Item'); // Primary Key
            $table->string('Item_name');
            $table->unsignedBigInteger('id_category'); // Foreign Key
            $table->integer('stock');
            $table->timestamps();

            // Relasi ke tabel kategori
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
}
