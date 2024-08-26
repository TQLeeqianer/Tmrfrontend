<?php

namespace App\Http\Controllers;

use App\Models\EventStall;
use Illuminate\Http\Client\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SSEController extends Controller
{
    public function stream()
    {
        $response = new StreamedResponse(function () {
            while (true) {
                echo "data: " . json_encode(['time' => now()->toDateTimeString()]) . "\n\n";
                ob_flush();
                flush();

                // 等待1秒后发送下一条消息
                sleep(1);
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }

    public function receivedSelectStall(Request $request)
    {


    }
    public function sendSelectedStall()
    {
            $selectedStall = EventStall::where('stall_owner_id', '=', null)
            ->where('status', 1)
            ->get();

            return response()->json($selectedStall);
    }
}
