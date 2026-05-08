<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class LibraryTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;

    protected $migrate = true;
    protected $refresh = true;
    protected $seed    = 'App\Database\Seeds\DatabaseSeeder';

    protected $sessionData;

    protected function setUp(): void
    {
        parent::setUp();

        // Simulasi data session untuk login admin
        $this->sessionData = [
            'user_id'   => 1,
            'nama'      => 'Admin Testing',
            'username'  => 'admin',
            'role'      => 'admin',
            'logged_in' => true,
        ];
    }

    /**
     * Use Case: Auth - Halaman Login
     */
    public function testLoginView()
    {
        $result = $this->get('/login');
        $result->assertStatus(200);
        $result->assertSee('Login');
    }

    /**
     * Use Case: Dashboard - Akses Dashboard Admin
     */
    public function testAdminDashboardAccess()
    {
        $result = $this->withSession($this->sessionData)
                       ->get('/admin/dashboard');

        $result->assertStatus(200);
        $result->assertSee('Dashboard');
    }

    /**
     * Use Case: Buku - List Buku
     */
    public function testBukuIndex()
    {
        $result = $this->withSession($this->sessionData)
                       ->get('/admin/buku');

        $result->assertStatus(200);
        $result->assertSee('Data Buku');
    }

    /**
     * Use Case: Buku - Tambah Buku
     */
    public function testBukuCreate()
    {
        $data = [
            'kode_buku'    => 'B001',
            'judul'        => 'PHP Unit Testing',
            'pengarang'    => 'Antigravity',
            'penerbit'     => 'DeepMind',
            'tahun_terbit' => '2026',
            'stok'         => 10,
            'stok_tersedia'=> 10
        ];

        $result = $this->withSession($this->sessionData)
                       ->post('/admin/buku/simpan', $data);

        // Biasanya redirect kembali ke list buku setelah simpan
        $result->assertRedirect();
    }

    /**
     * Use Case: Anggota - List Anggota
     */
    public function testAnggotaIndex()
    {
        $result = $this->withSession($this->sessionData)
                       ->get('/admin/anggota');

        $result->assertStatus(200);
        $result->assertSee('Data Anggota');
    }

    /**
     * Use Case: Anggota - Tambah Anggota
     */
    public function testAnggotaCreate()
    {
        $data = [
            'kode_anggota' => 'A001',
            'nama'         => 'Budi Sudarsono',
            'jenis_anggota'=> 'Siswa',
            'no_hp'        => '08123456789',
            'status'       => 'Aktif'
        ];

        $result = $this->withSession($this->sessionData)
                       ->post('/admin/anggota/simpan', $data);

        $result->assertRedirect();
    }

    /**
     * Use Case: Peminjaman - List Peminjaman
     */
    public function testPeminjamanIndex()
    {
        $result = $this->withSession($this->sessionData)
                       ->get('/admin/peminjaman');

        $result->assertStatus(200);
        $result->assertSee('Riwayat Peminjaman');
    }

    /**
     * Use Case: Peminjaman - Simpan Peminjaman
     */
    public function testPeminjamanSave()
    {
        $data = [
            'kode_pinjam' => 'PJ001',
            'anggota_id'  => 1,
            'buku_id'     => 1,
            'jumlah'      => 1,
            'tgl_pinjam'  => date('Y-m-d'),
            'tgl_kembali' => date('Y-m-d', strtotime('+7 days')),
            'petugas_id'  => 1,
            'status'      => 'Dipinjam'
        ];

        $result = $this->withSession($this->sessionData)
                       ->post('/admin/peminjaman/simpan', $data);

        $result->assertRedirect();
    }

    /**
     * Use Case: Pengembalian - List Pengembalian
     */
    public function testPengembalianIndex()
    {
        $result = $this->withSession($this->sessionData)
                       ->get('/admin/pengembalian');

        $result->assertStatus(200);
        $result->assertSee('Pengembalian Buku');
    }

    /**
     * Use Case: Laporan - Akses Laporan
     */
    public function testLaporanAccess()
    {
        $result = $this->withSession($this->sessionData)
                       ->get('/admin/pengembalian/laporan');

        $result->assertStatus(200);
    }
}
