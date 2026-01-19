<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use Illuminate\Http\Request;

/**
 * Controller DataTraining
 * Mengatur proses CRUD data training
 */
class DataTrainingController extends Controller
{
    /**
     * Menampilkan seluruh data training
     */
    public function index()
    {
        $data = DataTraining::all();
        return view('training.index', compact('data'));
    }

    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        return view('training.create');
    }

    /**
     * Menyimpan data training baru
     */
    public function store(Request $request)
    {
        DataTraining::create([
            'ipk' => $request->ipk,
            'penghasilan' => $request->penghasilan,
            'tanggungan' => $request->tanggungan,
            'status' => $request->status
        ]);

        return redirect()->route('training.index')
            ->with('success', 'Data training berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit data
     */
    public function edit($id)
    {
        $data = DataTraining::findOrFail($id);
        return view('training.edit', compact('data'));
    }

    /**
     * Update data training
     */
    public function update(Request $request, $id)
    {
        $data = DataTraining::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('training.index')
            ->with('success', 'Data training berhasil diperbarui');
    }

    /**
     * Hapus data training
     */
    public function destroy($id)
    {
        DataTraining::destroy($id);

        return redirect()->route('training.index')
            ->with('success', 'Data training berhasil dihapus');
    }
}
