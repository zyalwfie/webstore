    <?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Fetching Province...');
        $provinces = Http::get('https://wilayah.id/api/provinces.json')->json('data');

        foreach ($provinces as $province) {
            Region::create([
                'code' => data_get($province, 'code'),
                'name' => data_get($province, 'name'),
                'type' => 'province',
                'parent_code' => null
            ]);

            $this->command->info('Fetching Regency for ' . $province['name'] . '...');
            $regencies = Http::get('https://wilayah.id/api/regencies/' . $province['code'] . '.json')->json('data');
            foreach ($regencies as $regency) {
                Region::create([
                    'code' => data_get($regency, 'code'),
                    'name' => data_get($regency, 'name'),
                    'type' => 'regency',
                    'parent_code' => data_get($province, 'code')
                ]);

                $this->command->info('Fetching District for ' . $regency['name'] . '...');
                $districts = Http::get('https://wilayah.id/api/districts/' . $regency['code'] . '.json')->json('data');
                foreach ($districts as $district) {
                    Region::create([
                        'code' => data_get($district, 'code'),
                        'name' => data_get($district, 'name'),
                        'type' => 'district',
                        'parent_code' => data_get($regency, 'code')
                    ]);

                    $this->command->info('Fetching Village for ' . $district['name'] . '...');
                    $villages = Http::get('https://wilayah.id/api/villages/' . $district['code'] . '.json')->json('data');
                    foreach($villages as $village) {
                        Region::create([
                            'code' => data_get($village, 'code'),
                            'name' => data_get($village, 'name'),
                            'type' => 'village',
                            'postal_code' => data_get($village, 'code'),
                            'parent_code' => data_get($district, 'code')
                        ]);
                    }
                }
            }
        }
    }
}
