<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'adam',
                'no_telp' => '08812812312',
                'email' => 'adam@gmail.com',
                'password' => Hash::make('adamganteng'),
            ]
        ];

        Admin::insert($data);
    }
}
