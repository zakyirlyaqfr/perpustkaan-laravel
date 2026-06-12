<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Menu;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\Auth;

class MhsController extends Controller
{
    private function sidebarData(): array
    {
        $id_jenis_user = auth()->user()->id_jenis_user;

        $menususer = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
            $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })->whereNull('parent_id')->get();

        $submenus = Menu::whereHas('jenisUsers', function ($query) use ($id_jenis_user) {
            $query->where('setting_menu_user.id_jenis_user', $id_jenis_user);
        })->whereNotNull('parent_id')->get();

        return compact('menususer', 'submenus');
    }

    public function showbook()
    {
        return redirect()->route('mhs.addpinjaman');
    }

    public function addPinjaman()
    {
        $books = Buku::with(['kategori', 'activePinjaman'])
            ->where('status', true)
            ->get();

        $availableBooks = Buku::with('kategori')
            ->where('status', true)
            ->whereDoesntHave('activePinjaman')
            ->get();

        return view('mhs.addpinjaman', array_merge($this->sidebarData(), [
            'books' => $books,
            'availableBooks' => $availableBooks,
        ]));
    }

    public function storePinjaman(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'id_buku' => 'required|exists:buku,id_buku',
        ]);

        $bookIsBorrowed = Pinjaman::where('id_buku', $request->input('id_buku'))
            ->where('status', 'dipinjam')
            ->exists();

        if ($bookIsBorrowed) {
            return redirect()->back()->with('error', 'Buku sedang dipinjam.');
        }

        Pinjaman::create([
            'user_id' => Auth::id(),
            'id_buku' => $request->input('id_buku'),
            'nama' => $request->input('nama'),
            'nim' => $request->input('nim'),
            'status' => 'dipinjam',
            'tanggal_pinjam' => now(),
        ]);

        return redirect('/dashboard')->with('success', 'Buku berhasil dipinjam.');
    }

    public function pengembalian()
    {
        $pinjaman = Pinjaman::with('buku.kategori')
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->latest('tanggal_pinjam')
            ->get();

        return view('mhs.pengembalian', array_merge($this->sidebarData(), [
            'pinjaman' => $pinjaman,
        ]));
    }

    public function submitPengembalian($id)
    {
        $pinjaman = Pinjaman::where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->findOrFail($id);

        $pinjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        return redirect()->route('mhs.pengembalian')->with('success', 'Buku berhasil dikembalikan.');
    }
}
