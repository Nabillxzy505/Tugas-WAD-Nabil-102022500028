<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    // Akun contoh untuk menguji tiap peran (password semuanya: password123)
    public function run(): void
    {
        $akun = [
            ['name' => 'Admin Prodi',       'email' => 'admin@mail.com',     'role' => 'admin'],
            ['name' => 'Dosen Pembimbing',  'email' => 'dosen@mail.com',     'role' => 'dosen'],
            ['name' => 'Mahasiswa Uji',     'email' => 'mahasiswa@mail.com', 'role' => 'mahasiswa'],
        ];

        foreach ($akun as $a) {
            DB::table('users')->updateOrInsert(
                ['email' => $a['email']],
                [
                    'name'       => $a['name'],
                    'role'       => $a['role'],
                    'password'   => Hash::make('password123'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}