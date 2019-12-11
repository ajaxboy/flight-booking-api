<?php

use Illuminate\Database\Seeder;

class ReservationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Reservation::class, 50);
    }
}
