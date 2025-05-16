<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Data sekolah contoh
        $schools = [
            'SMA Negeri 1 Jakarta',
            'SMA Negeri 2 Bandung',
            'SMA Negeri 3 Surabaya',
            'SMA Negeri 4 Yogyakarta',
            'SMA Negeri 5 Medan'
        ];

        for ($i = 1; $i <= 50; $i++) {
            $joinDate = Carbon::now()->subMonths(rand(1, 12))->subDays(rand(1, 30));
            
            Member::create([
                'member_id' => 'SIS-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'name' => $faker->name,
                'email' => 'siswa' . $i . '@' . $faker->safeEmailDomain,
                'phone' => '08' . $faker->numerify('##########'),
                'type' => 'siswa',
                'address' => 'Jl. ' . $faker->streetName . ' No.' . $faker->buildingNumber . ', ' . $faker->city,
                'join_date' => $joinDate,
                'created_at' => $joinDate,
                'updated_at' => $joinDate
            ]);
        }

        // Tambahkan beberapa anggota lain untuk variasi
        Member::create([
            'member_id' => 'GUR-001',
            'name' => 'Dr. Bambang Sutrisno, M.Pd',
            'email' => 'bambang@sman1jkt.sch.id',
            'phone' => '081234567890',
            'type' => 'guru',
            'address' => 'Jl. Pendidikan No. 1, Jakarta',
            'join_date' => Carbon::now()->subYears(2)
        ]);

        Member::create([
            'member_id' => 'STF-001',
            'name' => 'Siti Aminah',
            'email' => 'aminah@sman1jkt.sch.id',
            'phone' => '082345678901',
            'type' => 'staff',
            'address' => 'Jl. Sekolah No. 5, Jakarta',
            'join_date' => Carbon::now()->subYears(1)
        ]);
    }
}