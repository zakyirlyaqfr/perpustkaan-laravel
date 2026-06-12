<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
        use HasFactory;
        protected $table = 'buku';
        protected $primaryKey = 'id_buku';
        protected $fillable = [
            'pengarang',
            'judul',
            'kode',
            'id_kategori',
            'status'
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class, 'id_buku', 'id_buku');
    }

    public function activePinjaman()
    {
        return $this->hasOne(Pinjaman::class, 'id_buku', 'id_buku')->where('status', 'dipinjam');
    }
}
