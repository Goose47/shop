<?php

namespace App\UseCases\Order;

use Illuminate\Http\Request;

class OrderProceedUseCase
{
    public function __invoke(Request $request)
    {
        return true;
    }
}
