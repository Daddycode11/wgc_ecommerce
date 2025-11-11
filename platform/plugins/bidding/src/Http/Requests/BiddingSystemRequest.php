<?php

namespace Botble\Bidding\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class BiddingSystemRequest extends Request
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'product_id' => 'required|exists:ec_products,id',
            'starting_price' => 'required|numeric|min:0',
            'min_bid_increment' => 'required|numeric|min:0',
            'end_time' => 'required|date',
            'image' => 'nullable|image|max:2048',
            'is_published' => [Rule::in(BaseStatusEnum::values())],
        ];
    }
}
