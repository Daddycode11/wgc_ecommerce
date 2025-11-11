<?php

namespace Botble\WalletTransactions\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class WalletTransactionsRequest extends Request
{
    public function rules(): array
    {
        return [
            "wallet_id" => "required|exists:wallets,id",
            "amount" => "required|numeric|min:0",
            "description" => "nullable|string",
            "reference" => "required|string",
            "status" => "required|string",
        ];
    }
}
