<?php

namespace App\Http\Controllers;

use App\Filters\OrderFilter;
use App\Http\Requests\Orders\OrderStoreRequest;
use App\Http\Requests\Orders\OrderUpdateRequest;
use App\Models\Order;
use App\Transformers\OrderTransformer;
use App\Transformers\SuccessTransformer;
use App\UseCases\Order\OrderStoreUseCase;
use App\UseCases\Order\OrderUpdateUseCase;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request, OrderFilter $filter)
    {
        return fractal(Order::filter($filter)->paginate($request->input('per_page', 10)), new OrderTransformer());
    }

    public function show(Order $order)
    {
        return fractal($order, new OrderTransformer());
    }

    public function store(
        OrderStoreRequest $request,
        OrderStoreUseCase $case
    )
    {
        return response(null, 303)->header('Location', $case($request));
//        return fractal($case($request), new UrlTransformer());
    }

    public function update(
        OrderUpdateRequest $request,
        OrderUpdateUseCase $case
    )
    {
        return fractal($case($request), new OrderTransformer());
    }

    public function proceedPayment()
    {
        //TODO: listen to stripe payment event and set order status
        return fractal(true, new SuccessTransformer());
    }
}
