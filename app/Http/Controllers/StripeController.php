<?php

namespace App\Http\Controllers;

use App\Models\EventStall;
use App\Models\SalesOrder;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\StripeClient;


class StripeController extends Controller
{
    public function processTransaction(Request $request): JsonResponse|string|null
    {
        $eventId = $request->get('eventId');
        $selectedStall = $request->get('selectedStall');

        $payAmount = 0;

        if (count($selectedStall) > 0) {
            foreach ($selectedStall as $stall) {
                $payAmount += $stall['price'];
            }
        }

        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );

        

        try {
            //Request new price
            $price = $stripe->prices->create([
                'unit_amount' => $payAmount * 100,
                'currency' => 'myr',
                'product' => 'prod_QdrqTTQFXebvao',
            ]);


            //Customer Info
            $customer = auth()->user();

            //Create Sales Order
            $salesOrder = new SalesOrder();
            $salesOrder->order_number = 'SO-' . time().'-'.rand(10,100);
            $salesOrder->total_price = $payAmount;
            $salesOrder->status = 'pending';
            $salesOrder->stall_info = json_encode($selectedStall);
            $salesOrder->customer_id = $customer->id;
            $salesOrder->customer_name = $customer->name;
            $salesOrder->save();


            //If Success, redirect to event page with success message

            //Make Payment
            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => [[
                    'price' => $price->id,
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('confirm-payment') . '?eventId=' . $eventId . '&order_number=' . $salesOrder->order_number,
                'cancel_url' => route('event', ['id' => $eventId]) . '?canceled=true'

//                   'success_url' => route('event', ['id' => $eventId]) . '?success=true',
//                'cancel_url' => route('event', ['id' => $eventId]) . '?canceled=true'
            ]);

            return $checkout_session->url;
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function successTransaction(Request $request)
    {
        $eventId = $request->get('eventId');
        $salesOrder = SalesOrder::where('order_number', $request->get('order_number'))->first();
        $salesOrder->status = 'paid';
        $salesOrder->save();


        $selectedStall = json_decode($salesOrder->stall_info, true);
        foreach ($selectedStall as $stall) {
            $stall = EventStall::where('stall_id', $stall['stallId'])->first();
            $stall->status = 1;
            $stall->stall_owner_id = $salesOrder->customer_id;
            $stall->booked_at = now();
            $stall->save();
        }

        $url = route('event', ['id' => $eventId]). '?success=true';


        return redirect()->to($url);
    }
}
