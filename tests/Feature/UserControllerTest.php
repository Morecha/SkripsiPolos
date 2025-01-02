<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use DatabaseTransactions;
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_store_user_with_valid_data()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe3@example.com',
            'password' => 'admin123',
            'role' => 'KepalaSekolah',
            'NIP' => '123456789012345678',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Jl. Kebon Jeruk',
            'jabatan' => 'Eselon 3',
            'status' => 'Aktif',
        ];

        $response = $this->post(route('users.store'), $data);

        $response->assertRedirect(route('users.list'));
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'user baru ditambahkan');

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'NIP' => $data['NIP'],
            'alamat' => $data['alamat'],
            'jabatan' => $data['jabatan'],
            'status' => $data['status'],
        ]);
    }

    public function test_store_user_with_existing_email()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe2@example.com',
            'password' => 'admin123',
            'role' => 'KepalaSekolah',
            'NIP' => '123456789012345678',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Jl. Kebon Jeruk',
            'jabatan' => 'Eselon 3',
            'status' => 'Aktif',
        ];

        $response = $this->post(route('users.store'), $data);

        $response->assertRedirect();
        $response->assertStatus(302);
        $response->assertSessionHas('error', 'user dengan email ini sudah ada');
    }

    public function test_store_user_with_invalid_data()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'role' => '',
            'NIP' => '',
            'tanggal_lahir' => '',
            'alamat' => '',
            'jabatan' => '',
            'status' => '',
        ];

        $response = $this->post(route('users.store'), $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name', 'email', 'password', 'role', 'NIP', 'tanggal_lahir',
            'alamat', 'jabatan', 'status',
        ]);
    }

    public function test_store_user_with_image_upload()
    {
        $user = User::find(1);
        $this->actingAs($user);
        Storage::fake('public');
        $image = UploadedFile::fake()->image('profile.jpg');

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => 'password123',
            'role' => 'Admin',
            'NIP' => '123456789012345678',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Kebon Jeruk',
            'jabatan' => 'Manager',
            'status' => 'Aktif',
            'image' => $image,
        ];

        $response = $this->post(route('users.store'), $data);

        $response->assertRedirect(route('users.list'))
                 ->assertSessionHas('success', 'user baru ditambahkan');

        $this->assertDatabaseHas('users', ['email' => $data['email']]);
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

        Storage::disk('public')->assertExists('gambar/profil/' . $profileImage);
    }
}
