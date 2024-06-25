<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemId extends Model
{
    use HasFactory;

    protected $table = 'item_id';

    protected $fillable = [
        'id',
        'name',
        'aanschafdatum',
        'tiernummer',
        'status',
        'picture',
    ];
}

