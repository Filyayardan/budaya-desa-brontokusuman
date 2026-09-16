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

        $palette = ['#d4a017', '#e74c3c', '#3498db', '#27ae60', '#9b59b6', '#e67e22', '#16a085', '#2c3e50'];
        $budayaColors = $budaya->values()
            ->mapWithKeys(fn($b, $i) => [$b->id => $palette[$i % count($palette)]]);

        $approvedBookings = Booking::with('budaya')
            ->where('status', 'approved')
            ->get()
            ->map(fn($bk) => [
                'tanggal' => $bk->tanggal_acara->format('Y-m-d'),
                'budaya_id' => $bk->budaya_id,
                'budaya' => $bk->budaya->judul ?? '-',
                'warna' => $budayaColors[$bk->budaya_id] ?? '#d4a017',
                'acara' => $bk->nama_acara,
            ]);

        return view('pages.booking', compact('budaya', 'approvedBookings', 'budayaColors'));
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
