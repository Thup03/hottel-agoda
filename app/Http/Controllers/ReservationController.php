<?php

namespace App\Http\Controllers;

use App\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $title = 'Danh sách đặt phòng';
        return view('reservation.reservations_list', ['reservations' => Reservation::all(), 'title' => $title]);
    }

    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
