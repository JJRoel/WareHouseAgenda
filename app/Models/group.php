<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'coler'];

    protected $table = 'group';

    public function items()
    {
        return $this->hasMany(ItemId::class, 'groupid');
    }
}


