<?php

namespace Botble\Bidding\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\Bidding\Http\Requests\BiddingSystemRequest;
use Botble\Bidding\Models\BiddingSystem;

class BiddingSystemForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new BiddingSystem())
            ->setValidatorClass(BiddingSystemRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label' => trans('core/base::forms.name'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'required' => true,
                'choices' => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
