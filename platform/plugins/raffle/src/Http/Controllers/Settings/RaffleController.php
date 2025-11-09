<?php

namespace Botble\Raffle\Http\Controllers\Settings;

use Botble\Base\Forms\FormBuilder;
use Botble\Raffle\Forms\Settings\RaffleForm;
use Botble\Raffle\Http\Requests\Settings\RaffleRequest;
use Botble\Setting\Http\Controllers\SettingController;

class RaffleController extends SettingController
{
    public function edit(FormBuilder $formBuilder)
    {
        $this->pageTitle('Page title');

        return $formBuilder->create(RaffleForm::class)->renderForm();
    }

    public function update(RaffleRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
