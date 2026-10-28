<?php
// 1. Class Induk
class Buku {
    protected $judul;
    protected $pengarang;
    protected $isTersedia;

    public function __construct($judul, $pengarang) {
        $this->judul = $judul;
        $this->pengarang = $pengarang;
        $this->isTersedia = true;
    }

    public function getJudul() {
        return $this->judul;
    }

    public function getPengarang() {
        return $this->pengarang;
    }

    public function cekTersedia() {
        return $this->isTersedia;
    }

    public function setTersedia($status) {
        $this->isTersedia = $status;
    }
}

// 2. Class Anak (Mewarisi Buku)
class Novel extends Buku {
    private $genre;

    public function __construct($judul, $pengarang, $genre) {
        parent::__construct($judul, $pengarang);
        $this->genre = $genre;
    }

    public function getJudul() {
        return $this->judul . " (Novel " . $this->genre . ")";
    }
}

// 3. Class Anggota
class Anggota {
    private $nama;
    private $idAnggota;

    public function __construct($nama, $idAnggota) {
        $this->nama = $nama;
        $this->idAnggota = $idAnggota;
    }

    public function getNama() {
        return $this->nama;
    }
}

// 4. Class Peminjaman
class Peminjaman {
    private $item;
    private $anggota;

    public function __construct($item, $anggota) {
        $this->item = $item;
        $this->anggota = $anggota;
    }

    public function prosesPinjam($waktuPinjam) {
        if ($this->item->cekTersedia()) {
            $this->item->setTersedia(false);
            
            echo "Detail Buku: '" . $this->item->getJudul() . "' karangan " . $this->item->getPengarang() . ".<br>";
            echo "Anggota perpustakaan " . strtolower($this->anggota->getNama()) . " meminjam buku '" . $this->item->getJudul() . "' pada " . $waktuPinjam . ".<br><br>";
        } else {
            echo "Gagal: Buku '" . $this->item->getJudul() . "' sedang tidak tersedia.<br>";
        }
    }

    public function prosesKembali($waktuKembali) {
        $this->item->setTersedia(true);
        echo "Buku '" . $this->item->getJudul() . "' telah dikembalikan oleh " . $this->anggota->getNama() . " pada " . $waktuKembali . ".<br>";
    }
}

// ==========================================
// INSTANSIASI DAN EKSEKUSI (MAIN)
// ==========================================

// Mengubah objek Anggota menjadi Gungrai dengan NIM baru
$anggotaGungrai = new Anggota("Gungrai", "250030632");

// Membuat objek Novel
$novelFiksi = new Novel("Laskar Pelangi", "Andrea Hirata", "Fiksi Pendidikan");

// Transaksi Peminjaman
$transaksi = new Peminjaman($novelFiksi, $anggotaGungrai);

// Eksekusi method pinjam dan kembali
$transaksi->prosesPinjam("28 Oktober 2026, pukul 10:00 WITA"); 
$transaksi->prosesKembali("30 Oktober 2026, pukul 14:30 WITA");
?>