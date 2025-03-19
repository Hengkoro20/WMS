<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $primaryKey = 'id_Item';
    protected $fillable = ['Item_name', 'id_category', 'stock'];

    // Relasi ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
