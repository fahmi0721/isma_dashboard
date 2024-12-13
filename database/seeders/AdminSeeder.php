<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->nama = "Fahmi Idrus";
        $admin->email = "fahmi@intansejahterautama.co.id";
        $admin->password = \Hash::make("Bacondeng@07");
        $admin->save();
        $this->command->info("Data user administrator Berhasil dibuat");
    }
}
