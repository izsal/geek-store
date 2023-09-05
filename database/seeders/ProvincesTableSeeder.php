<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Fetch Rest Api
        $response = Http::withHeaders([
            //api raja ongkir
            'key' => config('rajaongkir.api_key'),
        ])->get('https://api.rajaongkir.com/starter/province');

        //loop data from REST API
        foreach ($response['rajaongkir']['results'] as $province) {

            //insert ke table "provinces"
            Province::create([
                'id'    => $province['province_id'],
                'name'  => $province['province']
            ]);
        }
    }
}
