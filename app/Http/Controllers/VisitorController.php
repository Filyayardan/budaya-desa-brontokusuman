<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VisitorController extends Controller
{

    public function index(Request $request)
    {
        $request->validate(
            [
                'bulan' => ['nullable', 'date_format:Y-m'],
                'mulai' => ['nullable', 'date'],
                'selesai' => [
                    'nullable',
                    'date',
                    'after_or_equal:mulai',
                    function ($attribute, $value, $fail) use ($request) {
                        if ($request->filled('mulai')) {
                            $jumlahHari = Carbon::parse($request->mulai)
                                ->diffInDays(Carbon::parse($value));

                            if ($jumlahHari > 90) {
                                $fail('Rentang waktu maksimal adalah 90 hari.');
                            }
                        }
                    },
                ],
            ],
            [
                'selesai.after_or_equal' =>
                    'Tanggal sampai harus sama atau setelah tanggal mulai.',
            ]
        );
        
        $periode = $request->input('bulan');

        if (blank($periode)) {
            $periode = now()->format('Y-m');
        }

        [$tahun, $bulan] = explode('-', $periode);

        $mulai = $request->mulai;
        $selesai = $request->selesai;

        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::whereDate(
            'visited_at',
            today()
        )->count();
        $monthVisitors = Visitor::whereMonth('visited_at', $bulan)
            ->whereYear('visited_at', $tahun)
            ->count();

        $visitorPerHari = DB::table('visitors')
            ->selectRaw('DATE(visited_at) as hari, COUNT(DISTINCT session_id) as jumlah')
            ->whereYear('visited_at', $tahun)
            ->whereMonth('visited_at', $bulan)
            ->groupByRaw('DATE(visited_at)')
            ->orderBy('hari')
            ->get();

        $visitorLabels = $visitorPerHari->pluck('hari')->toArray();
        $visitorData = $visitorPerHari
            ->pluck('jumlah')
            ->map(fn($jumlah) => (int) $jumlah)
            ->toArray();

        $rangeVisitors = 0;

        if (filled($mulai) && filled($selesai)) {
            $rangeVisitors = Visitor::whereBetween('visited_at', [
                $mulai . ' 00:00:00',
                $selesai . ' 23:59:59',
            ])->count();
        }

        return view('admin.pengunjung.index', compact(
            'totalVisitors',
            'todayVisitors',
            'monthVisitors',
            'rangeVisitors',
            'visitorLabels',
            'visitorData'
        ));
    }
}
