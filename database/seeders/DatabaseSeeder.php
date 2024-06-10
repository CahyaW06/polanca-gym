<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Inventory;
use App\Models\ClassMember;
use App\Models\TrainingClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            if ($i <= 5) {
                User::create([
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'type' => 'trainer',
                    'password' => Hash::make('password123'),
                    'activated' => 1,
                ]);
            }
            else {
                User::create([
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'type' => 'trainer',
                    'password' => Hash::make('password123'),
                    'activated' => 0,
                ]);
            }

            Trainer::create([
                'user_id' => $i,
                'apply_letter' => "MtpD4r6n3Cian4TYKXXqWLhCfADPKHwUhxUFJyHL.pdf",
                'cv' => '1UBTaHaU1k436Fchgphi9q30bF2tziLF4Jk8Tk5l.pdf',
                'certificates' => "cv2uZTM41oYpxYU6JPLvT9IXzzw3DNFQ4Xie0fpT.pdf,N6NXcTsgcEgtmgldFbeaDyoDvCC0CTISXWrda1CY.pdf"
            ]);
        }

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'type' => 'admin',
            'password' => Hash::make('yudha123'),
        ]);

        User::create([
            'first_name' => 'Ahmad',
            'last_name' => 'Wijaya',
            'email' => 'yudhacahya@gmail.com',
            'type' => 'member',
            'password' => Hash::make('yudha123'),
            'activated' => 1,
            'membership_duration' => 4,
            'update_membership_at' => Carbon::parse('2024-03-26'),
            'membership_end_at' => Carbon::parse('2024-03-26')->addMonth(4)
        ]);

        User::create([
            'first_name' => 'Syahlan',
            'last_name' => 'Wigunatmo',
            'email' => 'syahlan@gmail.com',
            'type' => 'member',
            'password' => Hash::make('syahlanwigunatmo'),
            'activated' => 1,
            'membership_duration' => 0,
            'update_membership_at' => Carbon::now()->toDate(),
            'membership_end_at' => Carbon::parse("2024-05-25")
        ]);

        User::factory()->count(25)->create();

        TrainingClass::create([
            'name' => 'Yoga Class',
            'max_member' => 20,
            'max_trainer' => 3,
            'subs' => 200000
        ]);

        TrainingClass::create([
            'name' => 'Karate Class',
            'max_member' => 10,
            'max_trainer' => 5,
            'subs' => 100000
        ]);

        TrainingClass::find(1)->users()->attach([12, 13]);
        TrainingClass::find(1)->trainers()->attach([1, 2]);

        Inventory::factory()->count(30)->create();
    }
}
