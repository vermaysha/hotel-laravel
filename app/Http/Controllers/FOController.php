<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\LayananKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class FOController extends Controller
{
    public function index() {
        $kamars = Kamar::with([
            'booking' => function ($q) {
                $q->whereNot('status', 'completed');
        }, 'tarifs'])->get();

        return view('fo.index', [
            'kamars' => $kamars,
        ]);
    }

    public function history() {
        $bookings = Booking::with(['kamar', 'layananKamar'])->where('status', 'completed')->get();

        return view('fo.history', [
            'bookings' => $bookings,
        ]);
    }

    public function checkin($kamar_id) {
        $kamar = Kamar::findOrFail($kamar_id);
        $layananKamar = LayananKamar::all();

        return view('fo.checkin', [
            'kamar' => $kamar,
            'layananKamar' => $layananKamar,
        ]);
    }

    public function checkinProcess($kamar_id, Request $request) {
        if (Booking::where('kamar_id', $kamar_id)->whereIn('status', ['checkin', 'checkout'])->exists()) {
            return redirect()->back()->with('error', 'Kamar ini sedang dipakai');
        }

        $kamar = Kamar::findOrFail($kamar_id);

        $book = new Booking();
        $book->kamar_id = $kamar_id;
        $book->user_id = auth()->id();
        $book->start_at = $request->input('start');
        $book->end_at = $request->input('end');
        $book->status = 'checkin';
        $book->nama_pelanggan = $request->input('name');
        $book->kekurangan = ((int)( $kamar->tarifs->tarif_terpasang ?? $kamar->tarif_awal)) - ((int) $request->input('dp'));

        $book->save();

        $book->layananKamar()->sync($request->input('layanan_kamar'));

        return redirect()->route('fo.index')->with('success', 'Checkin success');
    }

    public function checkout($kamar_id) {
        $book = Booking::where('kamar_id', $kamar_id)->where('status', 'checkin')->first();

        return view('fo.checkout', [
            'booking' => $book,
        ]);
    }

    public function checkoutProcess($kamar_id, Request $request) {
        $book = Booking::where('kamar_id', $kamar_id)->where('status', 'checkin')->first();

        if (empty($book)) {
            return redirect()->route('fo.index')->with('success', 'Checkout success');
        }

        if (empty($book->kekurangan)) {
            $book->kekurangan = ((int)$book->kekurangan) - ((int)$request->input('pelunasan'));
        }
        $book->status = 'completed';
        $book->save();

        return redirect()->route('fo.index')->with('success', 'Checkout success');
    }

    public function printNota($booking_id, Request $request) {
        $booking = Booking::with(['kamar', 'layananKamar'])->findOrFail($booking_id);

        $pdf = Pdf::loadView('fo.invoice', [
            'booking' => $booking,
        ]);

        return $pdf->stream();

        return view('fo.invoice', [
            'booking' => $booking,
        ]);
    }
}
