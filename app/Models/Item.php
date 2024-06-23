<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item_id'; // Specify the table name

    protected $fillable = [
        'name',
        'code',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'item_id');
    }
}
