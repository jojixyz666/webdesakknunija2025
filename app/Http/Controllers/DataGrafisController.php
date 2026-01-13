<?php

namespace App\Http\Controllers;

use App\Models\DataApbdes;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataGrafisController extends Controller
{
    // Public method untuk menampilkan data grafis
    public function index(Request $request)
    {
        // Statistik Penduduk dari tabel Warga
        $totalPenduduk = Warga::count();
        $totalKepalaKeluarga = Warga::kepalaKeluarga()->count();
        $totalLakiLaki = Warga::lakiLaki()->count();
        $totalPerempuan = Warga::perempuan()->count();
        
        // Hitung wajib pilih untuk tahun saat ini
        $tahunSekarang = date('Y');
        $totalWajibPilih = Warga::whereRaw("YEAR('$tahunSekarang-12-31') - YEAR(tanggal_lahir) - (DATE_FORMAT('$tahunSekarang-12-31', '%m%d') < DATE_FORMAT(tanggal_lahir, '%m%d')) >= 17")->count();
        
        // Data per Kelompok Umur
        $dataKelompokUmur = Warga::all()->groupBy('kelompok_umur')->map(function($group) {
            return $group->count();
        })->sortKeys();
        
        // Data per Dusun
        $dataDusun = Warga::select('dusun', DB::raw('count(*) as jumlah'))
            ->groupBy('dusun')
            ->orderBy('dusun')
            ->get();
        
        // Data per Pendidikan
        $dataPendidikan = Warga::select('pendidikan', DB::raw('count(*) as jumlah'))
            ->whereNotNull('pendidikan')
            ->groupBy('pendidikan')
            ->orderBy('jumlah', 'desc')
            ->get();
        
        // Data Wajib Pilih per tahun (untuk chart bar)
        $tahunAwal = date('Y');
        $tahunAkhir = date('Y') + 10;
        $tahunRange = range($tahunAwal, $tahunAkhir);
        $dataWajibPilihPerTahun = [];
        $dataTidakWajibPilihPerTahun = [];
        
        foreach ($tahunRange as $tahun) {
            $wajibPilih = Warga::whereRaw("YEAR('$tahun-12-31') - YEAR(tanggal_lahir) - (DATE_FORMAT('$tahun-12-31', '%m%d') < DATE_FORMAT(tanggal_lahir, '%m%d')) >= 17")->count();
            $dataWajibPilihPerTahun[] = $wajibPilih;
            $dataTidakWajibPilihPerTahun[] = $totalPenduduk - $wajibPilih;
        }
        
        // Data APBDes - ambil tahun terbaru atau dari request
        $tahunApbdes = DataApbdes::distinct()->pluck('tahun')->sortDesc();
        $tahunApbdesAktif = $request->get('tahun_apbdes', $tahunApbdes->first() ?? date('Y'));
        $dataApbdes = DataApbdes::where('tahun', $tahunApbdesAktif)
            ->orderBy('kategori')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kategori');
        
        // Hitung total per kategori APBDes
        $totalPendapatan = $dataApbdes->get('Pendapatan', collect())->sum('jumlah');
        $totalBelanja = $dataApbdes->get('Belanja', collect())->sum('jumlah');
        $totalPembiayaanPenerimaan = $dataApbdes->get('Pembiayaan Penerimaan', collect())->sum('jumlah');
        $totalPembiayaanPengeluaran = $dataApbdes->get('Pembiayaan Pengeluaran', collect())->sum('jumlah');
        
        // Hitung Surplus/Defisit
        $surplusDefisit = ($totalPendapatan + $totalPembiayaanPenerimaan) - ($totalBelanja + $totalPembiayaanPengeluaran);
        
        return view('data-grafis.index', compact(
            'totalPenduduk',
            'totalKepalaKeluarga',
            'totalLakiLaki',
            'totalPerempuan',
            'totalWajibPilih',
            'dataKelompokUmur',
            'dataDusun',
            'dataPendidikan',
            'tahunRange',
            'dataWajibPilihPerTahun',
            'dataTidakWajibPilihPerTahun',
            'dataApbdes',
            'tahunApbdes',
            'tahunApbdesAktif',
            'totalPendapatan',
            'totalBelanja',
            'totalPembiayaanPenerimaan',
            'totalPembiayaanPengeluaran',
            'surplusDefisit'
        ));
    }

    // Admin - Data APBDes
    public function apbdesIndex()
    {
        $data = DataApbdes::orderBy('tahun', 'desc')->orderBy('kategori')->orderBy('urutan')->get();
        return view('admin.data-grafis.apbdes.index', compact('data'));
    }

    public function apbdesCreate()
    {
        return view('admin.data-grafis.apbdes.create');
    }

    public function apbdesStore(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100',
            'kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'urutan' => 'nullable|integer|min:0',
        ]);

        DataApbdes::create($request->all());

        return redirect()->route('admin.data-grafis.apbdes.index')
            ->with('success', 'Data APBDes berhasil ditambahkan.');
    }

    public function apbdesEdit(DataApbdes $dataApbdes)
    {
        return view('admin.data-grafis.apbdes.edit', compact('dataApbdes'));
    }

    public function apbdesUpdate(Request $request, DataApbdes $dataApbdes)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2100',
            'kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $dataApbdes->update($request->all());

        return redirect()->route('admin.data-grafis.apbdes.index')
            ->with('success', 'Data APBDes berhasil diperbarui.');
    }

    public function apbdesDestroy(DataApbdes $dataApbdes)
    {
        $dataApbdes->delete();

        return redirect()->route('admin.data-grafis.apbdes.index')
            ->with('success', 'Data APBDes berhasil dihapus.');
    }

}
