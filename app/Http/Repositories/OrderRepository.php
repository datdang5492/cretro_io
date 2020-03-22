<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class OrderRepository
{

    public function getOrder(string $oderId): array
    {
        try {
//            $data = DB::table('order')
//                ->where('shipment_id', $oderId)
//                ->get()
//                ->toArray();

            return [
                'created_at' => '2020-03-24',
                'currency' => 'eur',
                'total' => 14,
                'paymentMethod' => 'paypal',
                'totalWeight' => 10,
            ];
        } catch (Exception $e) {
            return [];
        }
    }
}
