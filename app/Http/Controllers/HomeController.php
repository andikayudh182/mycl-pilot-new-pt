<?php

namespace App\Http\Controllers;
use App\Models\Baglog\Pembibitan;
use App\Models\Baglog\Kontaminasi as KontaminasiBaglog;
use App\Models\Mylea\Produksi;
use App\Models\Mylea\Kontaminasi as KontaminasiMylea;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $ProduksiBaglog = Pembibitan::selectRaw("DATE_FORMAT(TanggalPengerjaan, '%Y-%m') AS label")
            ->selectRaw("sum(JumlahBaglog) as y")
            ->whereBetween('TanggalPengerjaan', [Carbon::now()->subMonth(6)->format('Y-m-01'), Carbon::now()->subMonth(1)->endOfMonth()])
            ->groupby('label')
            ->get();
        $KontaminasiBaglog = Pembibitan::selectRaw("DATE_FORMAT(TanggalPengerjaan, '%Y-%m') AS label")
            ->selectRaw("sum(baglog_kontaminasi.JumlahKonta) as y")
            ->whereBetween('baglog_pembibitan.TanggalPengerjaan', [Carbon::now()->subMonth(6)->format('Y-m-01'), Carbon::now()->subMonth(1)->endOfMonth()])
            ->join('baglog_kontaminasi','baglog_kontaminasi.KodeProduksi','=','baglog_pembibitan.KodeProduksi')
            ->groupby('label')
            ->get();
        $ProduksiMylea = Produksi::selectRaw("DATE_FORMAT(TanggalProduksi, '%Y-%m') AS label")
            ->selectRaw("sum(Jumlah) as y")
            ->whereBetween('TanggalProduksi', [Carbon::now()->subMonth(6)->format('Y-m-01'), Carbon::now()->subMonth(1)->endOfMonth()])
            ->groupby('label')
            ->get();
        $KontaminasiMylea = Produksi::selectRaw("DATE_FORMAT(TanggalProduksi, '%Y-%m') AS label")
            ->selectRaw("sum(mylea_kontaminasi.Jumlah) as y")
            ->whereBetween('mylea_produksi.TanggalProduksi', [Carbon::now()->subMonth(6)->format('Y-m-01'), Carbon::now()->subMonth(1)->endOfMonth()])
            ->join('mylea_kontaminasi','mylea_kontaminasi.KPMylea','=','mylea_produksi.KodeProduksi')
            ->groupby('label')
            ->get();
        return view('dashboard', [
            'Baglog' => $ProduksiBaglog,
            'KontaminasiBaglog'=>$KontaminasiBaglog,
            'Mylea' => $ProduksiMylea,
            'KontaminasiMylea' => $KontaminasiMylea,
        ]);
    }


    public function monthly()
    {
        $ProduksiBaglog = Pembibitan::selectRaw("DATE_FORMAT(TanggalPengerjaan, '%Y-%m-%d') AS label")
            ->selectRaw("sum(JumlahBaglog) as y")
            ->whereBetween('TanggalPengerjaan', [Carbon::now()->subMonth(1)->format('Y-m-01'), Carbon::now()->subMonth(1)->endOfMonth()])
            ->groupby('label')
            ->get();
        $KontaminasiBaglog = Pembibitan::selectRaw("DATE_FORMAT(TanggalPengerjaan, '%Y-%m-%d') AS label")
            ->selectRaw("sum(baglog_kontaminasi.JumlahKonta) as y")
            ->whereBetween('baglog_pembibitan.TanggalPengerjaan', [Carbon::now()->subMonth(1)->format('Y-m-01'), Carbon::now()->subMonth(1)->endOfMonth()])
            ->join('baglog_kontaminasi','baglog_kontaminasi.KodeProduksi','=','baglog_pembibitan.KodeProduksi')
            ->groupby('label')
            ->get();
        $ProduksiMylea = Produksi::selectRaw("DATE_FORMAT(TanggalProduksi, '%Y-%m-%d') AS label")
            ->selectRaw("sum(Jumlah) as y")
            ->whereBetween('TanggalProduksi', [Carbon::now()->subMonth(1)->format('Y-m-01'), Carbon::now()->subMonth(1)->endOfMonth()])
            ->groupby('label')
            ->get();
        $KontaminasiMylea = Produksi::selectRaw("DATE_FORMAT(TanggalProduksi, '%Y-%m-%d') AS label")
            ->selectRaw("sum(mylea_kontaminasi.Jumlah) as y")
            ->whereBetween('mylea_produksi.TanggalProduksi', [Carbon::now()->subMonth(1)->format('Y-m-01'), Carbon::now()->subMonth(1)->endOfMonth()])
            ->join('mylea_kontaminasi','mylea_kontaminasi.KPMylea','=','mylea_produksi.KodeProduksi')
            ->groupby('label')
            ->get();
        return view('DashboardMonthly', [
            'Baglog' => $ProduksiBaglog,
            'KontaminasiBaglog'=>$KontaminasiBaglog,
            'Mylea' => $ProduksiMylea,
            'KontaminasiMylea' => $KontaminasiMylea,
        ]);
    }

    public function StockCard()
    {
        return view('DashboardStockCard');
    }
}
