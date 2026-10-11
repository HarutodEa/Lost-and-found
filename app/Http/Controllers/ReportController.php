<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Menampilkan halaman utama
    public function index()
    {
        $reports = Report::with('user')->latest()->get();
        return view('reports.index', compact('reports'));
    }

    // Menyimpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:lost,found',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil ditambahkan!');
    }

    // Menampilkan halaman edit
    public function edit(Report $report)
    {
        // Hanya pemilik laporan yang bisa mengedit
        if (Auth::id() !== $report->user_id) {
            abort(403, 'Anda tidak bisa mengedit laporan orang lain.');
        }

        return view('reports.edit', compact('report'));
    }

    // Menyimpan perubahan edit
    public function update(Request $request, Report $report)
    {
        if (Auth::id() !== $report->user_id) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'type' => 'required|in:lost,found',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
        ]);

        $report->update($request->only('type', 'title', 'description', 'location'));

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    // Menghapus laporan (Bisa Admin ATAU Pemilik Laporan)
    public function destroy(Report $report)
    {
        if (Auth::user()->is_admin || Auth::id() === $report->user_id) {
            $report->delete();
            return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus.');
        }

        abort(403, 'Anda tidak memiliki akses untuk menghapus laporan ini.');
    }
}