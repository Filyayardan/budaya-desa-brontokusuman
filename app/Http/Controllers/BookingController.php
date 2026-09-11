<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        $budaya = Budaya::all();
        $approvedDates = Booking::where('status', 'approved')
            ->pluck('tanggal_acara')
            ->map(fn($d) => $d->format('Y-m-d'))
            ->unique()
            ->values()
            ->toArray();

        return view('pages.booking', compact('budaya', 'approvedDates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'budaya_id' => 'required|exists:budaya,id',
            'tanggal_acara' => 'required|date|after_or_equal:today',
            'nama_acara' => 'required|string|max:255',
            'lokasi_acara' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Booking::create($validated);

        return redirect()->route('booking.create')->with('success', 'Booking berhasil dikirim! Menunggu konfirmasi dari admin.');
    }
}
