<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReportController extends Controller
{
    public function __construct() {
        Carbon::setLocale('id');
        Carbon::setFallbackLocale('en');
    }

    public function index() {
        return view('report.index', [
        ]);
    }

    public function newCust() {
        $date = Carbon::now();
        $custs = Booking::groupBy('nama_pelanggan')->get();

        return view('report.newCust', [
            'custs' => $custs
        ]);
    }

    public function pendapatan() {
        $date = Carbon::now();
        $bookings = collect(DB::select("SELECT bookings.created_at, SUM(tarifs.tarif_terpasang) AS total FROM bookings
            INNER JOIN kamars ON kamars.id = bookings.kamar_id
            INNER JOIN tarifs ON tarifs.id = kamars.tarif_id
        GROUP BY MONTH(bookings.created_at)"));

        $bookings = $bookings->map(function ($q) {
            $class = new stdClass;
            $class->created_at = Carbon::parse($q->created_at);
            $class->total = intval($q->total);
            return $class;
        });

        return view('report.pendapatan', [
            'bookings' => $bookings,
            'bulan' => $date->isoFormat('MMMM gggg '),
        ]);
    }

    public function jumlahTamu() {
        $date = Carbon::now();
        $bookings = collect(DB::select("SELECT
        bookings.created_at, COUNT(tarifs.tarif_terpasang) AS total
        FROM bookings
        INNER JOIN kamars ON kamars.id = bookings.kamar_id
        INNER JOIN tarifs ON tarifs.id = kamars.tarif_id
        GROUP BY MONTH(bookings.created_at), bookings.nama_pelanggan"));

        $bookings = $bookings->map(function ($q) {
            $class = new stdClass;
            $class->created_at = Carbon::parse($q->created_at);
            $class->total = intval($q->total);
            return $class;
        });

        return view('report.jumlahTamu', [
            'bookings' => $bookings,
            'bulan' => $date->isoFormat('MMMM gggg '),
        ]);
    }

    public function bestOfFive() {
        $date = Carbon::now();

        $bookings = Booking::groupBy('nama_pelanggan')->get();

        $bestOfFive = $bookings->map(function ($booking) {
            $result = array_merge($booking->toArray(), [
                'total' => Booking::where('nama_pelanggan', $booking->nama_pelanggan)->count(),
            ]);

            return $result;
        })->sortByDesc('total')->take(5);

        return view('report.bestOfFive', [
            'custs' => $bestOfFive,
            'bulan' => $date->isoFormat('MMMM gggg '),
        ]);
    }
}
