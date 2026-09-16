<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingStatusMail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('budaya')->latest();

        $subAdmin = $this->currentSubAdmin();
        if ($subAdmin && !$subAdmin->isSuperAdminFor('budaya')) {
            $query->whereIn('budaya_id', $subAdmin->budayaItemIds());
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%")
                    ->orWhere('nama_acara', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(10)->withQueryString();
        return view('admin.booking.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        abort_unless($this->canManageBooking($booking), 403, 'Anda tidak memiliki akses ke booking ini.');
        $booking->load('budaya');
        return view('admin.booking.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        abort_unless($this->canManageBooking($booking), 403, 'Anda tidak memiliki akses ke booking ini.');
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $booking->update($validated);

        if ($booking->status === 'approved' && $booking->email) {
            try {
                Mail::to($booking->email)->send(new BookingStatusMail($booking->fresh('budaya')));
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Gagal mengirim email booking #' . $booking->id . ': ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.booking.show', $booking)->with('success', 'Status booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        abort_unless($this->canManageBooking($booking), 403, 'Anda tidak memiliki akses ke booking ini.');
        $booking->delete();
        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dihapus.');
    }

    private function canManageBooking(Booking $booking): bool
    {
        if (!$subAdmin = $this->currentSubAdmin()) {
            return true;
        }

        if ($subAdmin->isSuperAdminFor('budaya')) {
            return true;
        }

        return in_array($booking->budaya_id, $subAdmin->budayaItemIds(), true);
    }
}
