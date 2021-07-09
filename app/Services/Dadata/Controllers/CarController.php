<?php

namespace App\Services\Dadata\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Dadata\Requests\FindCarRequest;
use Dadata\DadataClient;
use Illuminate\Http\Exceptions\HttpResponseException;


class CarController extends Controller
{
    /**
     * @param FindCarRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCarTitle(FindCarRequest $request)
    {
        $token = config('services.dadata.token');
        $dadata = new DadataClient($token, null);

        try {
            $result = $dadata->suggest("car_brand", $request->partCarTitle);
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json($e->getMessage(), 422));
        }

        return response()->json($result);
    }
}
