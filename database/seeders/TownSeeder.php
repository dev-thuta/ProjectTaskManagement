<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = DB::table('states')->pluck('id', 'name');

        $towns = [
            'Yangon' => ['Hlaing', 'Mayangone', 'Insein', 'Thanlyin', 'South Okkalapa', 'North Okkalapa', 'Dagon', 'Bahan', 'Kamayut', 'Sanchaung', 'Latha', 'Pabedan', 'Kyauktada'],
            'Mandalay' => ['Chanayethazan', 'Amarapura', 'Pyin Oo Lwin', 'Mandalay Hill', 'Mandalay Palace', 'Maha Aungmye', 'Pyigyitagon', 'Aungmyaythazan', 'Mahaaungmyay'],
            'Sagaing' => ['Monywa', 'Shwebo', 'Sagaing', 'Katha', 'Kalay', 'Tamu', 'Monywa', 'Kani', 'Ye-U', 'Mawlaik'],
            'Bago' => ['Bago', 'Taungoo', 'Pyay', 'Tharrawaddy', 'Nyaunglebin', 'Kyaukkyi', 'Waw', 'Okpho'],
            'Magway' => ['Magway', 'Pakokku', 'Minbu', 'Gangaw', 'Chauk'],
            'Tanintharyi' => ['Dawei', 'Myeik', 'Tanintharyi', 'Kawthoung', 'Myeik', 'Kyunsu'],
            'Ayeyarwady' => ['Pathein', 'Hinthada', 'Mawlamyinegyun', 'Pyapon', 'Myaungmya', 'Kyaiklat', 'Kyaunggon'],
            'Kachin' => ['Myitkyina', 'Bhamo', 'Putao', 'Hpakant', 'Mogaung', 'Shwegu', 'Mohnyin'],
            'Kayah' => ['Loikaw', 'Hpasawng', 'Demoso', 'Bawlakhe'],
            'Kayin' => ['Hpa-An', 'Myawaddy', 'Kawkareik', 'Hlaingbwe', 'Kyainseikgyi'],
            'Mon' => ['Mawlamyine', 'Thaton', 'Kyaikto', 'Ye', 'Mudon', 'Paung'],
            'Rakhine' => ['Sittwe', 'Thandwe', 'Kyaukphyu', 'Mrauk U', 'Maungdaw', 'Buthidaung'],
            'Shan' => ['Taunggyi', 'Lashio', 'Kengtung', 'Mong Hsat', 'Mong La', 'Mongton', 'Mongnai', 'Mongpan'],
            'Chin' => ['Hakha', 'Falam', 'Tedim', 'Matupi', 'Mindat', 'Paletwa'],
        ];

        $now = now();

        foreach ($towns as $stateName => $townList) {
            $stateId = $states[$stateName] ?? null;
            if ($stateId) {
                foreach ($townList as $townName) {
                    $insertData[] = [
                        'name' => $townName,
                        'state_id' => $stateId,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }

        DB::table('towns')->insert($insertData);
    }
}
