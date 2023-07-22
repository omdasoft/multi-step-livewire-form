<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = \File::get("database/data/countries.json");
      $json = json_decode($json);
      $countries = [];
      foreach ($json as $key => $value) {
        $countries[]=[
          "id"=>$value->id,
          "country_code"=>$value->phonecode,
          "iso_code"=>$value->iso2,
          "name_en"=>$value->name,
          "name_ar"=>$value->name,
        ];

      }
      Country::insert($countries);
    }
}
