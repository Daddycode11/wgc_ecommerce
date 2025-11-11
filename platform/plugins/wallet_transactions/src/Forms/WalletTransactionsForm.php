<?php

namespace Botble\WalletTransactions\Forms;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\WalletTransactions\Http\Requests\WalletTransactionsRequest;
use Botble\WalletTransactions\Models\WalletTransactions;

class WalletTransactionsForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(WalletTransactions::class)
            ->setValidatorClass(WalletTransactionsRequest::class)
            ->add('wallet_id', "hidden")
            ->add('amount', TextField::class, NameFieldOption::make()->required())
            ->add('description')
            ->add('reference')
            ->add('status',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label("Status")
                        ->choices(array(
                            'pending' => 'Pending',
                            'added' => 'Added',
                            'failed' => 'Failed',
                        ))
                        ->toArray()
            )
            ->setBreakFieldPoint('status');
    }
}
