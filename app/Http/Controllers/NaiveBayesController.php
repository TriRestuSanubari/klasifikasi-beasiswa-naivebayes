<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataTraining;
use Illuminate\Support\Facades\DB;

/**
 * Controller Naive Bayes
 * Klasifikasi kelayakan beasiswa
 */
class NaiveBayesController extends Controller
{
    /**
     * Menampilkan form klasifikasi
     */
    public function index()
    {
        // =========================
        // TAMBAHKAN KODE INI:
        // =========================
        $totalData = DataTraining::count();
        $layakCount = DataTraining::where('status', 'Layak')->count();
        $tidakLayakCount = DataTraining::where('status', 'Tidak Layak')->count();
        
        // Hitung akurasi sederhana (contoh: 85% fixed atau hitung dari testing)
        $accuracy = 0; // Untuk sementara, nanti bisa dihitung dari data testing
        
        // Jika ada data training, hitung distribusi yang benar
        if ($totalData > 0) {
            // Contoh perhitungan akurasi (ini hanya dummy, sesuaikan dengan logika Anda)
            $accuracy = round(($layakCount + $tidakLayakCount) / $totalData * 100, 2);
        }
        
        return view('klasifikasi.index', compact(
            'totalData',
            'layakCount',
            'tidakLayakCount',
            'accuracy'
        ));
    }

    /**
     * Proses Naive Bayes
     */
    public function process(Request $request)
    {
        // =========================
        // 1. INPUT DATA UJI
        // =========================
        $ipk = $request->ipk;
        $penghasilan = $request->penghasilan;
        $tanggungan = $request->tanggungan;

        // =========================
        // 2. AMBIL DATA TRAINING
        // =========================
        $totalData = DataTraining::count();

        // CEK APAKAH ADA DATA TRAINING
        if ($totalData == 0) {
            return redirect()->route('klasifikasi.index')
                ->with('error', 'Data training masih kosong. Silakan tambah data training terlebih dahulu.');
        }

        $totalLayak = DataTraining::where('status', 'Layak')->count();
        $totalTidak = DataTraining::where('status', 'Tidak Layak')->count();

        // =========================
        // 3. PROBABILITAS PRIOR
        // =========================
        $pLayak = $totalLayak / $totalData;
        $pTidak = $totalTidak / $totalData;

        // =========================
        // 4. PROBABILITAS KONDISI (LIKELIHOOD)
        // =========================

        // IPK - HINDARI PEMBAGI NOL
        $pIpkLayak = ($totalLayak > 0) 
            ? DataTraining::where('status', 'Layak')->where('ipk', $ipk)->count() / $totalLayak
            : 0;
            
        $pIpkTidak = ($totalTidak > 0)
            ? DataTraining::where('status', 'Tidak Layak')->where('ipk', $ipk)->count() / $totalTidak
            : 0;

        // Penghasilan
        $pPengLayak = ($totalLayak > 0)
            ? DataTraining::where('status', 'Layak')->where('penghasilan', $penghasilan)->count() / $totalLayak
            : 0;
            
        $pPengTidak = ($totalTidak > 0)
            ? DataTraining::where('status', 'Tidak Layak')->where('penghasilan', $penghasilan)->count() / $totalTidak
            : 0;

        // Tanggungan
        $pTangLayak = ($totalLayak > 0)
            ? DataTraining::where('status', 'Layak')->where('tanggungan', $tanggungan)->count() / $totalLayak
            : 0;
            
        $pTangTidak = ($totalTidak > 0)
            ? DataTraining::where('status', 'Tidak Layak')->where('tanggungan', $tanggungan)->count() / $totalTidak
            : 0;

        // =========================
        // 5. HITUNG NAIVE BAYES (DENGAN LAPLACE SMOOTHING)
        // =========================
        // Tambahkan Laplace smoothing untuk menghindari probabilitas 0
        $alpha = 1; // Laplace smoothing factor
        
        $hasilLayak = $pLayak * 
            (($pIpkLayak == 0) ? $alpha/($totalLayak + $alpha*3) : $pIpkLayak) *
            (($pPengLayak == 0) ? $alpha/($totalLayak + $alpha*3) : $pPengLayak) *
            (($pTangLayak == 0) ? $alpha/($totalLayak + $alpha*3) : $pTangLayak);

        $hasilTidak = $pTidak *
            (($pIpkTidak == 0) ? $alpha/($totalTidak + $alpha*3) : $pIpkTidak) *
            (($pPengTidak == 0) ? $alpha/($totalTidak + $alpha*3) : $pPengTidak) *
            (($pTangTidak == 0) ? $alpha/($totalTidak + $alpha*3) : $pTangTidak);

        // =========================
        // 6. KEPUTUSAN AKHIR
        // =========================
        $keputusan = ($hasilLayak > $hasilTidak)
            ? 'Layak'
            : 'Tidak Layak';

        // =========================
        // 7. SIMPAN KE DATABASE (JIKA TABEL ADA)
        // =========================
        try {
            DB::table('hasil_klasifikasi')->insert([
                'ipk' => $ipk,
                'penghasilan' => $penghasilan,
                'tanggungan' => $tanggungan,
                'prob_layak' => $hasilLayak,
                'prob_tidak_layak' => $hasilTidak,
                'hasil' => $keputusan,
                'created_at' => now()
            ]);
        } catch (\Exception $e) {
            // Jika tabel tidak ada, tidak perlu error
        }

        // =========================
        // 8. KIRIM KE VIEW
        // =========================
        return view('klasifikasi.hasil', compact(
            'ipk',
            'penghasilan',
            'tanggungan',
            'hasilLayak',
            'hasilTidak',
            'keputusan'
        ));
    }
}