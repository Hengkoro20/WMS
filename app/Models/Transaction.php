<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';
    protected $fillable = ['id_Item', 'amount', 'transaction_date', 'transaction_type'];

    // Relasi ke model Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'id_Item');
    }
}

