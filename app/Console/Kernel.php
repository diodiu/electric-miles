<?php

namespace App\Console;

use App\Models\DelayedOrder;
use App\Models\Order;
use App\Models\StatusEnum;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $now = new \DateTime();

            $orders = Order::where('expectedTimeOfDelivery', '<', $now->format('Y-m-d H:i:s'))
                ->where('status', '=', StatusEnum::NEW)
                ->get();

            foreach ($orders as $order) {
                DelayedOrder::create([
                    'expectedTimeOfDelivery' => $order->expectedTimeOfDelivery,
                    'order_id' => $order->id
                ]);
                $order->status = StatusEnum::DELAYED;
                $order->save();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
