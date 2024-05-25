<?php

namespace Database\Seeders;

use App\Models\Trainer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'Yudha Cahya',
            'last_name' => 'Wijaya',
            'email' => 'yudhacahyawijaya@gmail.com',
            'type' => 'trainer',
            'password' => Hash::make('yudha123'),
        ]);
        User::create([
            'first_name' => 'Ahmad',
            'last_name' => 'Wijaya',
            'email' => 'yudhacahya@gmail.com',
            'type' => 'member',
            'password' => Hash::make('yudha123'),
        ]);

        Trainer::create([
            'user_id' => 1,
            'apply_letter' => "MtpD4r6n3Cian4TYKXXqWLhCfADPKHwUhxUFJyHL.pdf",
            'cv' => '1UBTaHaU1k436Fchgphi9q30bF2tziLF4Jk8Tk5l.pdf',
            'certificates' => "cv2uZTM41oYpxYU6JPLvT9IXzzw3DNFQ4Xie0fpT.pdf,N6NXcTsgcEgtmgldFbeaDyoDvCC0CTISXWrda1CY.pdf"
        ]);
    }
}
