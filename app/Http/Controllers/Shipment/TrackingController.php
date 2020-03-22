<?php

namespace App\Http\Controllers\Shipment;

use App\Http\Controllers\Controller;
use App\Http\Repositories\OrderRepository;
use App\Http\Repositories\TrackingRepository;
use Exception;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * @var TrackingRepository
     */
    private $trackingRepo;

    /**
     * @var OrderRepository
     */
    private $orderRepo;


    public function __construct(TrackingRepository $trackingRepo, OrderRepository $orderRepo)
    {
        $this->trackingRepo = $trackingRepo;
        $this->orderRepo = $orderRepo;
    }

    public function trackShipment(Request $request)
    {
        $this->validate($request, [
            'orderId' => 'required|alpha_num|size:8'
        ]);

        try {
            $orderId = $request->input('orderId');
            $data = $this->orderRepo->getOrder($orderId);
            $data['progress'] = $this->trackingRepo->getShipmentProgress($orderId);

            return response()->json($data, 200);

        } catch (Exception $e) {
//            return response()->json(['message' => $e->getMessage()], 500);
            return response()->json(['message' => 'Something wrong happened!'], 500);
        }
    }
}
