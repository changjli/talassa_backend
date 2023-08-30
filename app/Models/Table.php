<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function Reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
