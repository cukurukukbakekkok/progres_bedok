<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\CalonSiswa;
use App\Models\GelombangPendaftaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutoAssignKelasTest extends TestCase
{
    use RefreshDatabase;

    private $jurusan;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup jurusan
        $this->jurusan = Jurusan::create([
            'nama' => 'RPL',
            'slug' => 'rpl',
            'keterangan' => 'Rekayasa Perangkat Lunak'
        ]);
    }

    /**
     * Test: Auto-assign ke kelas yang tersedia
     */
    public function test_auto_assign_ke_kelas_tersedia()
    {
        // Setup: Buat kelas dengan capacity 25, sudah 5 siswa
        $kelas = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 5,
        ]);

        // Test: Auto-assign
        $result = Kelas::autoAssignKelas('RPL');

        // Assert: Harus kelas yang tersedia
        $this->assertNotNull($result);
        $this->assertEquals($kelas->id, $result->id);
        $this->assertEquals('RPL 1', $result->nama);
        $this->assertFalse($result->isFull());
    }

    /**
     * Test: Auto-create kelas baru jika penuh
     */
    public function test_auto_create_kelas_baru_jika_penuh()
    {
        // Setup: Buat kelas RPL 1 dengan kapasitas 25, sudah penuh
        $kelas1 = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 25, // PENUH
        ]);

        // Test: Auto-assign
        $result = Kelas::autoAssignKelas('RPL');

        // Assert: Harus kelas baru (RPL 2)
        $this->assertNotNull($result);
        $this->assertNotEquals($kelas1->id, $result->id);
        $this->assertEquals('RPL 2', $result->nama);
        $this->assertEquals(0, $result->jumlah_siswa);
        $this->assertTrue($result->isFull() === false);

        // Verify: Kelas 1 masih ada
        $this->assertTrue(Kelas::where('id', $kelas1->id)->exists());
    }

    /**
     * Test: Increment jumlah siswa
     */
    public function test_increment_jumlah_siswa()
    {
        $kelas = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 0,
        ]);

        $kelas->increment('jumlah_siswa');
        $kelas->refresh();

        $this->assertEquals(1, $kelas->jumlah_siswa);
    }

    /**
     * Test: Decrement jumlah siswa
     */
    public function test_decrement_jumlah_siswa()
    {
        $kelas = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 5,
        ]);

        $kelas->decrement('jumlah_siswa');
        $kelas->refresh();

        $this->assertEquals(4, $kelas->jumlah_siswa);
    }

    /**
     * Test: Decrement tidak boleh kurang dari 0
     */
    public function test_decrement_tidak_boleh_negatif()
    {
        $kelas = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 0,
        ]);

        $kelas->safeDecrement();
        $kelas->refresh();

        $this->assertTrue($kelas->jumlah_siswa >= 0);
    }

    /**
     * Test: Get sisa kapasitas
     */
    public function test_get_sisa_kapasitas()
    {
        $kelas = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 10,
        ]);

        $this->assertEquals(15, $kelas->getSisaKapasitas());
    }

    /**
     * Test: Check kelas penuh
     */
    public function test_is_full()
    {
        $kelasPenuh = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 25,
        ]);

        $kelasKosong = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 2',
            'kapasitas' => 25,
            'jumlah_siswa' => 0,
        ]);

        $this->assertTrue($kelasPenuh->isFull());
        $this->assertFalse($kelasKosong->isFull());
    }

    /**
     * Test: Registrasi siswa dengan auto-assign
     */
    public function test_registrasi_siswa_dengan_auto_assign()
    {
        // Setup
        $user = User::factory()->create();
        $gelombang = GelombangPendaftaran::create([
            'nama' => 'Gelombang 1',
            'status' => 'aktif',
            'kuota' => 100,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(30),
        ]);

        // Buat kelas RPL 1
        $kelas = Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 0,
        ]);

        // Test: Registrasi
        $response = $this->actingAs($user)->post('/siswa/pendaftaran', [
            'id_gelombang' => $gelombang->id,
            'nama_lengkap' => 'John Doe',
            'nisn' => '1234567890',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2008-05-15',
            'jenis_kelamin' => 'Laki-laki',
            'asal_sekolah' => 'SMP Negeri 1',
            'nama_orang_tua' => 'Jane Doe',
            'alamat' => 'Jl. Test',
            'no_hp' => '081234567890',
            'jurusan' => 'RPL',
        ]);

        // If registration failed, surface the error message from session to help debug
        if ($response->getSession()->has('error')) {
            $this->fail('Registration failed: ' . $response->getSession()->get('error'));
        }

        // Assert: Siswa berhasil didaftar
        $this->assertDatabaseHas('calon_siswas', [
            'user_id' => $user->id,
            'jurusan' => 'RPL',
            'kelas_id' => $kelas->id,
        ]);

        // Assert: Kelas count bertambah
        $kelas->refresh();
        $this->assertEquals(1, $kelas->jumlah_siswa);
    }

    /**
     * Test: Multiple siswa auto-assign ke kelas berbeda
     */
    public function test_multiple_siswa_auto_assign()
    {
        // Setup
        $gelombang = GelombangPendaftaran::create([
            'nama' => 'Gelombang 1',
            'status' => 'aktif',
            'kuota' => 100,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(30),
        ]);

        // Kelas dengan kapasitas 2
        Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 2,
            'jumlah_siswa' => 0,
        ]);

        // Registrasi 3 siswa
        for ($i = 1; $i <= 3; $i++) {
            $user = User::factory()->create();
            
            $this->actingAs($user)->post('/siswa/pendaftaran', [
                'id_gelombang' => $gelombang->id,
                'nama_lengkap' => "Siswa {$i}",
                'nisn' => "123456789{$i}",
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2008-05-15',
                'jenis_kelamin' => 'Laki-laki',
                'asal_sekolah' => 'SMP Negeri 1',
                'nama_orang_tua' => 'Parent',
                'alamat' => 'Jl. Test',
                'no_hp' => '0812345678' . $i,
                'jurusan' => 'RPL',
            ]);
        }

        // Assert: 2 siswa di RPL 1, 1 siswa di RPL 2
        $kelas1 = Kelas::where('nama', 'RPL 1')->first();
        $kelas2 = Kelas::where('nama', 'RPL 2')->first();

        $this->assertEquals(2, $kelas1->jumlah_siswa);
        $this->assertNotNull($kelas2);
        $this->assertEquals(1, $kelas2->jumlah_siswa);
    }

    /**
     * Test: Auto-assign jurusan tidak ada
     */
    public function test_auto_assign_jurusan_tidak_ada()
    {
        // Test: Auto-assign dengan jurusan yang tidak ada
        $result = Kelas::autoAssignKelas('TIDAK_ADA');

        // Assert: Return null
        $this->assertNull($result);
    }

    /**
     * Test: Get total siswa di jurusan
     */
    public function test_get_total_siswa_jurusan()
    {
        // Setup: Buat 2 kelas, total 30 siswa
        Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 15,
        ]);

        Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 2',
            'kapasitas' => 25,
            'jumlah_siswa' => 15,
        ]);

        // Test
        $total = $this->jurusan->getTotalSiswa();

        // Assert
        $this->assertEquals(30, $total);
    }

    /**
     * Test: Get total kapasitas jurusan
     */
    public function test_get_total_kapasitas_jurusan()
    {
        // Setup: Buat 2 kelas, total kapasitas 50
        Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 1',
            'kapasitas' => 25,
            'jumlah_siswa' => 0,
        ]);

        Kelas::create([
            'jurusan_id' => $this->jurusan->id,
            'nama' => 'RPL 2',
            'kapasitas' => 25,
            'jumlah_siswa' => 0,
        ]);

        // Test
        $total = $this->jurusan->getTotalKapasitas();

        // Assert
        $this->assertEquals(50, $total);
    }
}
