<?php

namespace App\Http\Controllers;

use App\Http\Requests\DelayedOrderRequest;
use App\Models\DelayedOrder;

class DelayedOrderController extends Controller
{
    public function delayed(DelayedOrderRequest $request)
    {
        $params = $request->all();

        return DelayedOrder::whereBetween('created_at', [$params['startTime'], $params['endTime']])->get();
    }
}
