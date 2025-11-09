<?php

namespace Botble\Raffle\Http\Requests;

use Botble\Support\Http\Requests\Request;

class RaffleRequest extends Request
{
    public function rules(): array
    {
        return [
            'event_name' => 'required|string|max:255',
            'entry_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:entry_date',
            'draw_date' => 'nullable|date|after:end_date',
            'prize_type' => 'required|string|in:item,coupon,voucher',
            'ticket_price' => 'nullable|numeric|min:0',
            'status' => 'required|string',
        ];
    }
}
