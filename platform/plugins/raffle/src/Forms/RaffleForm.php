<?php

namespace Botble\Raffle\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Raffle\Http\Requests\RaffleRequest;
use Botble\Raffle\Models\Raffle;

class RaffleForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Raffle())
            ->setValidatorClass(RaffleRequest::class)
            ->withCustomFields()
            ->add('event_name', 'text', [
                'label' => 'Raffle Event Name',
                'required' => true,
                'attr' => ['placeholder' => 'Enter raffle event name'],
            ])
            ->add('entry_date', 'text', [
                'label' => 'Entry Start Date',
                'required' => true,
                'attr' => [
                    'type' => 'datetime-local',
                    
                    'value' => $this->getModel() ? $this->getModel()->entry_date?->format('Y-m-d\TH:i') : null,
                ],
            ])
            ->add('end_date', 'text', [
                'label' => 'Entry End Date',
                'required' => true,
                'attr' => [
                    'type' => 'datetime-local',
                    'value' => $this->getModel() ? $this->getModel()->end_date?->format('Y-m-d\TH:i') : null,
                ],
            ])
            ->add('draw_date', 'text', [
                'label' => 'Draw Date',
                'required' => false,
                'attr' => [
                    'type' => 'datetime-local',
                    'value' => $this->getModel() ? $this->getModel()->draw_date?->format('Y-m-d\TH:i') : null,
                ],
            ])
            ->add('prize_type', 'customSelect', [
                'label' => 'Prize Type',
                'choices' => [
                    'item' => 'Item',
                    'coupon' => 'Coupon',
                    'voucher' => 'Voucher',
                ],
            ])
            ->add('prize_description', 'textarea', [
                'label' => 'Prize Description',
                'attr' => ['rows' => 3],
            ])
            ->add('prize_image', 'mediaImage', [
                'label' => 'Prize Image',
            ])
            ->add('number_of_tickets', 'number', [
                'label' => 'Number of Tickets',
                'default_value' => 0,
            ])
            ->add('ticket_price', 'text', [
                'label' => 'Ticket Price (₱)',
                'default_value' => '0.00',
            ])
            ->add('status', 'customSelect', [
                'label' => 'Status',
                'choices' => BaseStatusEnum::labels(),
                'required' => true,
            ])
            ->setBreakFieldPoint('status');
    }
}
