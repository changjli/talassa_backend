<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Bool_;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function Table()
    {
        return $this->belongsTo(Table::class);
    }

    public function Shift()
    {
        return $this->belongsTo(Reservat::class);
    }

    public function Booking()
    {
        return $this->hasOne(Booking::class);
    }
}
