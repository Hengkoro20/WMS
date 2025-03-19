<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('id_report'); // Primary Key
            $table->unsignedBigInteger('id_Item'); // Foreign Key
            $table->integer('current_stock');
            $table->date('report_date');
            $table->integer('total_in');
            $table->integer('total_out');
            $table->timestamps();

            // Relasi ke tabel items
            $table->foreign('id_Item')->references('id_Item')->on('items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
