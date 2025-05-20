<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Gets the order as an object.
     *
     * @param Request $request
     * @param string $OrderId
     * 
     * @return JsonResponse
     */
    public function getOrder(Request $request, string $orderId): JsonResponse
    {
        LOG::debug("entro", ['orderid' => $orderId]);
        $data = [
            "id" => 2000003508419013,
            "status" => "paid",
            "status_detail" => null,
            "date_created" => "2013-05-27T10:01:50.000-04:00",
            "date_closed" => "2013-05-27T10:04:07.000-04:00",
            "order_items" => [
                [
                    "item" => [
                        "id" => "MLB12345678",
                        "title" => "Samsung Galaxy",
                        "variation_id" => null,
                        "variation_attributes" => []
                    ],
                    "quantity" => 1,
                    "unit_price" => 499,
                    "currency_id" => "BRL"
                ]
            ],
            "total_amount" => 499,
            "currency_id" => "BRL",
            "buyer" => [
                "id" => "123456789",
            ],
            "seller" => [
                "id" => "123456789",
            ],
            "payments" => [
                [
                    "id" => "596707837",
                    "transaction_amount" => 499,
                    "currency_id" => "BRL",
                    "status" => "approved",
                    "date_created" => null,
                    "date_last_modified" => null
                ]
            ],
            "feedback" => [
                "purchase" => null,
                "sale" => null
            ],
            "context" => [
                "channel" => "marketplace",
                "site" => "MLB",
                "flows" => [
                    0
                ]
            ],
            "shipping" => [
                "id" => 20676482441
            ],
            "tags" => [
                "no_shipping",
                "paid",
                "not_delivered"
            ]
        ];


        $percentage = 90;
        $roll = rand(1, 100);

        if ($roll <= $percentage) {
            return response()->json([
                'error' => 'Too Many Requests',
                'message' => "You have been rate-limited (simulated with {$percentage}% probability)."
            ], 429);
        }
        if ($orderId == '1') {
            return response()->json(json_encode($data), Response::HTTP_OK);
        }

        return response()->json([
            'error' => 'order not found'
        ], Response::HTTP_NOT_FOUND);
    }
    /**
     * Gets the shipment label related to an order.
     *
     * @param Request $request
     * @param string $OrderId
     * 
     * @return JsonResponse
     */
    public function getShipmentLabel(Request $request, string $orderId): JsonResponse
    {

        return response()->json([]);
    }

    public function refreshToken(Request $request){
        LOG::debug("refreshed called");
        return response()->json([
            'access_token' => 'mock_access_token_123',
            'token_type' => 'bearer',
            'expires_in' => 21600,
            'scope' => 'read write',
            'user_id' => 123456789,
        ], Response::HTTP_OK);
    }
}
