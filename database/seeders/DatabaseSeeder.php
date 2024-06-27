<?php

namespace Database\Seeders;

use App\Models\ClassHistory;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Inventory;
use App\Models\ClassMember;
use App\Models\History;
use App\Models\Setting;
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
        User::create([
            'first_name' => "Syahlan",
            'last_name' => "Wijaya",
            'email' => "trainer@gmail.com",
            'type' => 'trainer',
            'password' => Hash::make('password123'),
            'activated' => 1,
            'update_membership_at' => Carbon::now()
        ]);

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'type' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'first_name' => 'Surojo',
            'last_name' => 'Di Ningrat',
            'email' => 'user@gmail.com',
            'type' => 'member',
            'password' => Hash::make('password123'),
            'activated' => 1,
            'membership_duration' => 0,
            'update_membership_at' => Carbon::now()->toDate(),
            'membership_end_at' => Carbon::now()->subMonth()
        ]);

        User::create([
            'first_name' => 'Syahlan',
            'last_name' => 'Wigunatmo',
            'email' => 'syahlan@gmail.com',
            'type' => 'member',
            'password' => Hash::make('syahlanwigunatmo'),
            'activated' => 1,
            'membership_duration' => 5,
            'update_membership_at' => Carbon::now()->toDate(),
            'membership_end_at' => Carbon::now()->addMonth(5)
        ]);

        for ($i = 1; $i <= 3; $i++) {
            if ($i <= 2) {
                User::create([
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'type' => 'trainer',
                    'password' => Hash::make('password123'),
                    'activated' => 1,
                    'update_membership_at' => Carbon::now()
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
                    'update_membership_at' => Carbon::now()
                ]);
            }

            Trainer::create([
                'user_id' => $i+5,
                'apply_letter' => "application_letter.pdf",
                'cv' => 'CV.pdf',
                'certificates' => "Sertifikat.pdf"
            ]);
        }

        User::factory()->count(5)->create();

        TrainingClass::create([
            'name' => 'Yoga Class',
            'max_member' => 20,
            'max_trainer' => 3,
            'subs' => 200000,
            'img' => "dummy_class.jpg",
            'desc' => 'Our yoga classes are suitable for all levels, led by experienced instructors. Focus on balancing body and mind, improving flexibility, strength and mental health.',
            'day' => 'Monday',
            'time' => Carbon::createFromFormat('H:i', '07:00')->format('H:i')
        ]);

        TrainingClass::create([
            'name' => 'Karate Class',
            'max_member' => 10,
            'max_trainer' => 5,
            'subs' => 100000,
            'img' => "dummy_class.jpg",
            'desc' => "Our karate classes offer intensive training for all levels. Guided by experienced instructors, participants learn basic to advanced techniques, as well as discipline and character development.",
            'day' => 'Tuesday',
            'time' => Carbon::createFromFormat('H:i', '08:00')->format('H:i')
        ]);

        TrainingClass::find(1)->users()->attach([12, 13]);
        TrainingClass::find(1)->trainers()->attach([1, 2]);

        Inventory::factory()->count(30)->create();

        Setting::create([
            'gym_name' => "Polanca GYM",
            'gym_motto' => 'Be A Sigma Mewing Man',
            'payment_one_month' => 69999,
            'payment_three_month' => 169999,
            'payment_five_month' => 269999,
        ]);

        $dummyMemberId = [3, 4, 8, 9, 10, 11, 12];
        for ($i = 0; $i < 100; $i++) {
            History::create([
                'user_id' => $dummyMemberId[array_rand($dummyMemberId)],
                'membership_type' => rand(1, 3),
                'proof' => "bukti_pembayaran.jpg",
                'update_date' => Carbon::today()->subDays(rand(0, 365))
            ]);

            ClassHistory::create([
                'user_id' => $dummyMemberId[array_rand($dummyMemberId)],
                'training_class_id' => rand(1, 2),
                'proof' => "bukti_pembayaran.jpg",
                'update_date' => Carbon::today()->subDays(rand(0, 365))
            ]);
        }
    }
}
