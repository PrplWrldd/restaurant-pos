<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['items', 'status'];

    // Scope to get only completed orders
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
