<?php

namespace Database\Seeders;

use App\Models\Admin\Nationality;
use Illuminate\Database\Seeder;

class NationalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = \File::get("database/data/nationality.json");
      $json = json_decode($json);
      $nationalities = [];
        foreach ($json as $key => $value) {
          $nationalities[]=[
            "num_code"=>$value->num_code,
            "alpha_2_code"=>$value->alpha_2_code,
            "alpha_3_code"=>$value->alpha_3_code,
            "en_short_name"=>$value->en_short_name,
            "nationality"=>$value->nationality,
          ];
  
        }
      Nationality::insert($nationalities);
    }
}
