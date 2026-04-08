<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'Pandu Admin',
            'email' => 'panduadmin@gmail.com',
            'password' => bcrypt('pandusetya'),
            'peran' => 'admin',
        ]);

        Kategori::create(['ket_kategori' => 'Kebersihan']);
        Kategori::create(['ket_kategori' => 'Keamanan']);
        Kategori::create(['ket_kategori' => 'Kerusakan']);
        Kategori::create(['ket_kategori' => 'Lainnya']);

        User::create([
            'name' => 'Kevin',
            'username' => 'kevin',
            'nis' => '120313990',
            'kelas' => 'XII RPL 1',
            'email' => 'kevin@gmail.com',
            'password' => bcrypt('12345678'),
            'peran' => 'siswa',
        ]);

        User::create([
            'name' => 'Radit',
            'username' => 'radit',
            'nis' => '12931293',
            'kelas' => 'XII RPL 2',
            'email' => 'radit@gmail.com',
            'password' => bcrypt('12345678'),
            'peran' => 'siswa',
        ]);

        User::create([
            'name' => 'Rasya',
            'username' => 'rasya',
            'nis' => '1293938',
            'kelas' => 'XI TKJ 2',
            'email' => 'rasya@gmail.com',
            'password' => bcrypt('12345678'),
            'peran' => 'siswa',
        ]);

        User::create([
            'name' => 'Taufiq',
            'username' => 'taufiq',
            'nis' => '18231873',
            'kelas' => 'XI TKJ 2',
            'email' => 'taufiq@gmail.com',
            'password' => bcrypt('12345678'),
            'peran' => 'siswa',
        ]);

        User::create([
            'name' => 'Rehan',
            'username' => 'rehan',
            'nis' => '12389232',
            'kelas' => 'XII RPL 2',
            'email' => 'rehan@gmail.com',
            'password' => bcrypt('12345678'),
            'peran' => 'siswa',
        ]);
    }
}
