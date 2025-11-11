<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleEntries extends Model
{
    use HasFactory;
    protected $table = 'raffle_entries';
    protected $fillable = ['raffle_promo_id','customer_id','entry_code'];
}
