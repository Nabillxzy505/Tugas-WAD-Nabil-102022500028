<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    // READ: tampilkan semua data (SELECT)
    public function index()
    {
        $mahasiswa = Mahasiswa::orderByDesc('id')->get();

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // CREATE (1/2): tampilkan form kosong
    public function create()
    {
        return view('mahasiswa.form', ['mahasiswa' => new Mahasiswa()]);
    }

    // CREATE (2/2): simpan data baru (INSERT)
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    // UPDATE (1/2): tampilkan form berisi data lama
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.form', compact('mahasiswa'));
    }

    // UPDATE (2/2): simpan perubahan (UPDATE)
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validate($this->rules($mahasiswa->id));

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    // DELETE: hapus data (DELETE)
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data berhasil dihapus!');
    }

    // Aturan validasi (dipakai untuk store & update)
    private function rules(?int $id = null): array
    {
        return [
            'nama'     => ['required', 'string', 'max:100'],
            'nim'      => ['required', 'digits_between:1,20', Rule::unique('mahasiswa', 'nim')->ignore($id)],
            'angkatan' => ['required', 'integer', 'between:2000,2100'],
            'sks'      => ['required', 'integer', 'between:0,200'],
            'status'   => ['required', Rule::in(['Aktif', 'Non-Aktif', 'Cuti'])],
        ];
    }
}