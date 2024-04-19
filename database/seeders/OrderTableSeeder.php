<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'payment_id' => 1,
                'user_id' => 3,
                'course_id' => 1,
                'instructor_id' => 2,
                'course_title' => 'Khoa luyen thi tieng anh',
                'price' => 110,
            ],
        ]);
    }
}
