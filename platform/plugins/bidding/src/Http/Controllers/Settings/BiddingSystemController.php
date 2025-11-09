<?php

namespace Botble\Bidding\Http\Controllers\Settings;

use Botble\Base\Forms\FormBuilder;
use Botble\Bidding\Forms\Settings\BiddingSystemForm;
use Botble\Bidding\Http\Requests\Settings\BiddingSystemRequest;
use Botble\Setting\Http\Controllers\SettingController;

class BiddingSystemController extends SettingController
{
    public function edit(FormBuilder $formBuilder)
    {
        $this->pageTitle('Page title');

        return $formBuilder->create(BiddingSystemForm::class)->renderForm();
    }

    public function update(BiddingSystemRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
