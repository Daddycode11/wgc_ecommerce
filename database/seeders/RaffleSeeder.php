<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Botble\Raffle\Models\Raffle;

class RaffleSeeder extends Seeder
{
    public function run(): void
    {
        $raffles = [
            [
                'event_name' => 'Halloween Lucky Draw 2025',
                'entry_date' => '2025-10-01 22:07:00',
                'end_date'   => '2025-10-26 17:09:00',
                'draw_date'  => '2025-10-31 18:00:00',
                'prize_type' => 'item',
                'prize_description' => 'Win a brand-new Smart Watch! Plus 3 consolation prizes for early participants.',
                'prize_image' => 'raffles/smartwatch.png',
                'number_of_tickets' => 500,
                'ticket_price' => 50.00,
                'status' => 'published',
            ],
            [
                'event_name' => 'Winter Coupon Bonanza',
                'entry_date' => '2025-12-01 09:00:00',
                'end_date'   => '2025-12-20 23:59:00',
                'draw_date'  => '2025-12-25 12:00:00',
                'prize_type' => 'coupon',
                'prize_description' => 'Get a 50% discount coupon for our winter collection!',
                'prize_image' => 'raffles/coupon.png',
                'number_of_tickets' => 300,
                'ticket_price' => 20.00,
                'status' => 'published',
            ],
            [
                'event_name' => 'New Year Voucher Giveaway',
                'entry_date' => '2025-12-28 10:00:00',
                'end_date'   => '2025-12-31 23:00:00',
                'draw_date'  => '2026-01-01 10:00:00',
                'prize_type' => 'voucher',
                'prize_description' => 'Win vouchers worth $100 to spend in January!',
                'prize_image' => 'raffles/voucher.png',
                'number_of_tickets' => 200,
                'ticket_price' => 30.00,
                'status' => 'published',
            ],
            [
                'event_name' => 'Summer Special Item Raffle',
                'entry_date' => '2026-06-01 08:00:00',
                'end_date'   => '2026-06-15 20:00:00',
                'draw_date'  => '2026-06-20 18:00:00',
                'prize_type' => 'item',
                'prize_description' => 'Win a limited edition summer gift pack!',
                'prize_image' => 'raffles/summer_pack.png',
                'number_of_tickets' => 400,
                'ticket_price' => 40.00,
                'status' => 'published',
            ],
        ];

        foreach ($raffles as $raffle) {
            Raffle::create($raffle);
        }
    }
}
