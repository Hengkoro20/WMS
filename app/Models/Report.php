<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $primaryKey = 'id_report';
    protected $fillable = ['id_Item', 'current_stock', 'report_date', 'total_in', 'total_out'];

    // Relasi ke model Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'id_Item');
    }
}

