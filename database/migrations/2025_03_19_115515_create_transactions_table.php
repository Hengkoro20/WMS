<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction'); // Primary Key
            $table->unsignedBigInteger('id_Item'); // Foreign Key
            $table->integer('amount');
            $table->date('transaction_date');
            $table->enum('transaction_type', ['in', 'out']); // 'in' untuk pemasukan, 'out' untuk pengeluaran
            $table->timestamps();

            // Relasi ke tabel items
            $table->foreign('id_Item')->references('id_Item')->on('items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
