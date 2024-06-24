<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'start_date',
        'end_date',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public static function createBooking(array $data, $userId = null)
    {
        $data['user_id'] = 2;

        if (isset($data['item_name'])) {
            $items = Item::where('name', $data['item_name'])->get();
            $availableItem = null;
            foreach ($items as $item) {
                $bookings = self::where('item_id', $item->id)
                    ->where(function ($query) use ($data) {
                        $query->whereBetween('start_date', [$data['start_date'], $data['end_date']])
                            ->orWhereBetween('end_date', [$data['start_date'], $data['end_date']])
                            ->orWhere(function ($query) use ($data) {
                                $query->where('start_date', '<', $data['start_date'])
                                    ->where('end_date', '>', $data['end_date']);
                            });
                    })->get();

                if ($bookings->isEmpty()) {
                    $availableItem = $item;
                    break;
                }
            }

            if ($availableItem) {
                $data['item_id'] = $availableItem->id;
                unset($data['item_name']);
            } else {
                throw new \Exception('No available items for the selected dates');
            }
        }

        return self::create($data);
    }
}
