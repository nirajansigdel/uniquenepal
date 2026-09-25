<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Career::create([
            'title' => 'Community Clean-Up Volunteer',
            'description' => 'Help us beautify our city by volunteering for our monthly community clean-up day. Tasks will include picking up litter, planting flowers, and helping with recycling efforts. No prior experience needed – just bring your energy and enthusiasm!',
            'location' => 'Downtown City Park',
            'date' => '2025-08-10',
            'time' => '9:00 AM – 1:00 PM',
            'spots_available' => 25,
            'salary' => 'Volunteer Position - No Salary',
            'requirements' => 'Comfortable clothing, water bottle, and willingness to work outdoors.',
            'status' => true,
        ]);

        Career::create([
            'title' => 'Youth Education Coordinator',
            'description' => 'Join our team to coordinate educational programs for youth in underserved communities. You will be responsible for developing curriculum, organizing workshops, and mentoring young students. This is a great opportunity to make a lasting impact on children\'s lives.',
            'location' => 'Community Learning Center',
            'date' => '2025-08-15',
            'time' => '10:00 AM – 4:00 PM',
            'spots_available' => 10,
            'salary' => '$45,000 - $55,000 annually',
            'requirements' => 'Teaching experience preferred, strong communication skills, and passion for youth development.',
            'status' => true,
        ]);

        Career::create([
            'title' => 'Environmental Conservation Assistant',
            'description' => 'Support our environmental conservation efforts by assisting with tree planting, wildlife monitoring, and environmental education programs. Help preserve our natural resources for future generations.',
            'location' => 'Nature Reserve',
            'date' => '2025-08-20',
            'time' => '8:00 AM – 2:00 PM',
            'spots_available' => 15,
            'salary' => '$35,000 - $42,000 annually',
            'requirements' => 'Interest in environmental conservation, comfortable working outdoors, and ability to work in various weather conditions.',
            'status' => true,
        ]);
    }
}
