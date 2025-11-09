<?php

namespace Botble\Raffle\Models;

use Botble\Base\Models\BaseModel;
use Botble\Base\Enums\BaseStatusEnum;

class Raffle extends BaseModel
{
    protected $table = 'raffles';

    protected $fillable = [
        'event_name',
        'entry_date',
        'end_date',
        'draw_date',
        'prize_type',
        'prize_description',
        'prize_image',
        'number_of_tickets',
        'ticket_price',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'entry_date' => 'datetime',
        'end_date' => 'datetime',
        'draw_date' => 'datetime',
        'status' => BaseStatusEnum::class,
        'is_featured' => 'boolean',
    ];
}
