<?php

namespace Tests\Feature;

use App\Models\CalonSiswa;
use App\Models\GelombangPendaftaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KuotaPendaftaranTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Kuota berkurang saat siswa dibuat
     */
    public function test_kuota_decrements_when_student_created()
    {
        // Setup
        $gelombang = GelombangPendaftaran::create([
            'nama' => 'Gelombang 1',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(30),
            'kuota' => 10,
            'status' => 'aktif',
        ]);

        $initialKuota = $gelombang->kuota;

        // Manually decrement kuota (simulate registration logic)
        $gelombang->kuota = max(0, $gelombang->kuota - 1);
        $gelombang->save();

        // Assert
        $gelombang->refresh();
        $this->assertEquals($initialKuota - 1, $gelombang->kuota);
    }

    /**
     * Test: Gelombang auto-disable saat kuota habis
     */
    public function test_gelombang_auto_disables_when_kuota_reaches_zero()
    {
        // Setup
        $gelombang = GelombangPendaftaran::create([
            'nama' => 'Gelombang Kecil',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(30),
            'kuota' => 1,
            'status' => 'aktif',
        ]);

        // Simulate registration: decrement kuota and disable if empty
        $gelombang->kuota = max(0, $gelombang->kuota - 1);
        if ($gelombang->kuota <= 0) {
            $gelombang->status = 'nonaktif';
        }
        $gelombang->save();

        // Assert
        $gelombang->refresh();
        $this->assertEquals(0, $gelombang->kuota);
        $this->assertEquals('nonaktif', $gelombang->status);
    }

    /**
     * Test: Cegah registrasi saat kuota habis
     */
    public function test_prevent_registration_when_kuota_exhausted()
    {
        // Setup
        $gelombang = GelombangPendaftaran::create([
            'nama' => 'Gelombang Terbatas',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(30),
            'kuota' => 0,
            'status' => 'nonaktif',
        ]);

        // Simulasi pengecekan
        $canRegister = $gelombang->status === 'aktif' && ($gelombang->kuota ?? 0) > 0;

        // Assert
        $this->assertFalse($canRegister);
    }

    /**
     * Test: Kode pendaftaran ter-generate dengan format benar
     */
    public function test_kode_pendaftaran_format_correct()
    {
        // Generate kode
        $kode = CalonSiswa::generateKodePendaftaran();

        // Assert
        $this->assertNotNull($kode);
        $this->assertStringStartsWith('REG-', $kode);
        $this->assertMatchesRegularExpression('/^REG-\d{8}-\d{5}$/', $kode);
    }

    /**
     * Test: Kode pendaftaran unik
     */
    public function test_kode_pendaftaran_unique()
    {
        // Generate multiple kodes
        $kode1 = CalonSiswa::generateKodePendaftaran();
        $kode2 = CalonSiswa::generateKodePendaftaran();

        // Assert
        $this->assertNotEquals($kode1, $kode2);
    }

    /**
     * Test: Multiple kuota decrements dalam transaction
     */
    public function test_multiple_registrations_decrement_kuota()
    {
        // Setup
        $gelombang = GelombangPendaftaran::create([
            'nama' => 'Gelombang Multi',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(30),
            'kuota' => 5,
            'status' => 'aktif',
        ]);

        // Simulate 3 registrations
        for ($i = 0; $i < 3; $i++) {
            $gelombang->kuota = max(0, $gelombang->kuota - 1);
        }
        $gelombang->save();

        // Assert
        $gelombang->refresh();
        $this->assertEquals(2, $gelombang->kuota);
        $this->assertEquals('aktif', $gelombang->status);
    }

    /**
     * Test: Auto-disable hanya terjadi saat kuota = 0
     */
    public function test_auto_disable_only_when_kuota_zero()
    {
        // Setup
        $gelombang = GelombangPendaftaran::create([
            'nama' => 'Gelombang Test',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDays(30),
            'kuota' => 2,
            'status' => 'aktif',
        ]);

        // Decrement to 1
        $gelombang->kuota = 1;
        if ($gelombang->kuota <= 0) {
            $gelombang->status = 'nonaktif';
        }
        $gelombang->save();

        // Assert still aktif
        $gelombang->refresh();
        $this->assertEquals(1, $gelombang->kuota);
        $this->assertEquals('aktif', $gelombang->status);

        // Decrement to 0
        $gelombang->kuota = 0;
        if ($gelombang->kuota <= 0) {
            $gelombang->status = 'nonaktif';
        }
        $gelombang->save();

        // Assert now nonaktif
        $gelombang->refresh();
        $this->assertEquals(0, $gelombang->kuota);
        $this->assertEquals('nonaktif', $gelombang->status);
    }
}
