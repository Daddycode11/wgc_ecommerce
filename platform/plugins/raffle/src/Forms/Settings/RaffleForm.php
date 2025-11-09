<?php

namespace Botble\Raffle\Forms\Settings;

use Botble\Raffle\Http\Requests\Settings\RaffleRequest;
use Botble\Setting\Forms\SettingForm;

class RaffleForm extends SettingForm
{
    public function buildForm(): void
    {
        parent::buildForm();

        $this
            ->setSectionTitle('Setting title')
            ->setSectionDescription('Setting description')
            ->setValidatorClass(RaffleRequest::class);
    }
}
