<?php

namespace App\Http\Controllers;

use App\Models\CarNumber;
use Illuminate\Http\Request;

class RnisSubscribeController extends Controller
{
    public function rnis_subscribe_update(Request $request)
    {
        $truc_number = trim($request->input('truc_number', ''));
        $end_subscribe = trim($request->input('end_subscribe', ''));
        $token = trim($request->input('token', ''));

        if ($token !== config('rnis_subscribe.token')) {
            abort(403, 'Отказанно в доступе');
        }

        $car_number = CarNumber::where('truc_number', $truc_number)->first();
        if (! $car_number) {
            abort(404, 'ГРЗ не найден в базе');
        }

        $normalized_end_subscribe = date('Y-m-d', strtotime($end_subscribe));

        $subscribe = $car_number->rnis_subscribe()
            ->whereDate('end_subscribe', $normalized_end_subscribe)
            ->first();

        if ($subscribe) {
            $subscribe->update([
                'end_subscribe' => $normalized_end_subscribe,
            ]);
        } else {
            $car_number->rnis_subscribe()->updateOrCreate(
                ['truc_number' => $truc_number],
                ['end_subscribe' => $normalized_end_subscribe],
            );
        }

        return response()->json([
            'message' => 'Данные обновлены',
        ], 200);
    }
}
