<?php

namespace Botble\Bidding\Forms\Settings;

use Botble\Bidding\Http\Requests\Settings\BiddingSystemRequest;
use Botble\Setting\Forms\SettingForm;

class BiddingSystemForm extends SettingForm
{
    public function buildForm(): void
    {
        parent::buildForm();

        $this
            ->setSectionTitle('Setting title')
            ->setSectionDescription('Setting description')
            ->setValidatorClass(BiddingSystemRequest::class);
    }
}
