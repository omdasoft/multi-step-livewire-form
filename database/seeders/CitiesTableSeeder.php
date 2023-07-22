<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ini_set('memory_limit', '400M');

      $json = \File::get("database/data/cities.json");
      $json = json_decode($json);
      $cities = [];
      foreach ($json as $key => $value) {
        $cities[]=[
          "id"=>$value->id,
          "country_id"=>$value->country_id,
          "state_id"=>$value->state_id,
          "name_en"=>$value->name,
          "name_ar"=>$value->name,
        ];
        if(count($cities)==500){
          City::insert($cities);
          $cities = [];
        }

      }
      if(count($cities)){
        City::insert($cities);
      }
    }
}
