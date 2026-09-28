<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Member;
use App\Models\Attendance;
use App\Models\Finance;
use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $memberUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->admin = User::where('role', 'admin')->first();
        $this->memberUser = User::where('role', 'anggota')->first();
    }

    public function test_public_pages_return_200(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('SMECONE ARCHERY CLUB');
        $this->get('/kepengurusan')->assertStatus(200)->assertSee('Kepengurusan SAC');
        $this->get('/login')->assertStatus(200)->assertSee('Selamat Datang Kembali');
    }

    public function test_unauthenticated_users_redirected_to_login(): void
    {
        $this->get('/anggota')->assertRedirect('/login');
        $this->get('/absensi')->assertRedirect('/login');
        $this->get('/iuran')->assertRedirect('/login');
        $this->get('/jadwal')->assertRedirect('/login');
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_authenticated_admin_can_access_all_pages(): void
    {
        $this->actingAs($this->admin)->get('/anggota')->assertStatus(200)->assertSee('Daftar Anggota');
        $this->actingAs($this->admin)->get('/absensi')->assertStatus(200)->assertSee('Absensi Latihan');
        $this->actingAs($this->admin)->get('/iuran')->assertStatus(200)->assertSee('Iuran & Keuangan');
        $this->actingAs($this->admin)->get('/jadwal')->assertStatus(200)->assertSee('Jadwal Latihan');
        $this->actingAs($this->admin)->get('/admin')->assertStatus(200)->assertSee('Dashboard Administrator');
    }

    public function test_member_crud_operations(): void
    {
        // 1. Create member as Admin
        $response = $this->actingAs($this->admin)->post('/anggota', [
            'name' => 'Siswa Pengujian Ujian',
            'nisn' => '0099887766',
            'class' => 'X RPL 3',
            'division' => 'Recurve',
            'role' => 'Anggota',
            'phone' => '089912345678',
            'status' => 'Aktif',
        ]);
        $response->assertRedirect('/anggota');

        $member = Member::where('name', 'Siswa Pengujian Ujian')->first();
        $this->assertNotNull($member);

        // 2. Update member
        $this->actingAs($this->admin)->put('/anggota/' . $member->id, [
            'name' => 'Siswa Pengujian Updated',
            'class' => 'XI RPL 3',
            'division' => 'Compound',
            'role' => 'Anggota',
            'status' => 'Aktif',
            'dues_status' => 'Lunas',
        ])->assertRedirect('/anggota');

        $member->refresh();
        $this->assertEquals('Siswa Pengujian Updated', $member->name);
        $this->assertEquals('XI RPL 3', $member->class);

        // 3. Delete member
        $this->actingAs($this->admin)->delete('/anggota/' . $member->id)->assertRedirect('/anggota');
        $this->assertNull(Member::where('name', 'Siswa Pengujian Updated')->first());
    }

    public function test_attendance_recording(): void
    {
        $member = Member::first();
        $this->assertNotNull($member);

        $response = $this->actingAs($this->admin)->post('/absensi', [
            'member_id' => $member->id,
            'status' => 'hadir',
            'date' => date('Y-m-d'),
            'notes' => 'Catatan tes kehadiran',
        ]);
        $response->assertRedirect('/absensi?date=' . date('Y-m-d'));

        $att = Attendance::where('member_id', $member->id)->where('date', date('Y-m-d'))->first();
        $this->assertNotNull($att);
        $this->assertEquals('hadir', $att->status);
    }

    public function test_finance_recording_and_mark_paid(): void
    {
        $member = Member::first();
        $this->assertNotNull($member);

        // Record payment as Admin
        $response = $this->actingAs($this->admin)->post('/iuran', [
            'type' => 'masuk',
            'category' => 'Iuran Bulanan',
            'amount' => 25000,
            'date' => date('Y-m-d'),
            'payment_method' => 'QRIS',
            'member_id' => $member->id,
            'period' => 'September 2026',
        ]);
        $response->assertRedirect('/iuran');

        // Mark paid
        $response2 = $this->actingAs($this->admin)->post('/iuran/' . $member->id . '/mark-paid');
        $response2->assertRedirect('/iuran');
        $member->refresh();
        $this->assertEquals('Lunas', $member->dues_status);
    }

    public function test_csv_exports(): void
    {
        $this->actingAs($this->admin)->get('/anggota/export')->assertStatus(200)->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $this->actingAs($this->admin)->get('/absensi/export')->assertStatus(200)->assertHeader('content-type', 'text/csv; charset=UTF-8');
        $this->actingAs($this->admin)->get('/iuran/export')->assertStatus(200)->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }

    public function test_quick_demo_login(): void
    {
        $this->get('/login/demo/admin')->assertRedirect('/admin');
        $this->assertAuthenticated();
    }
}
