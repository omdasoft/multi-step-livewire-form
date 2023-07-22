<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\State;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = \File::get("database/data/states.json");
      $json = json_decode($json);
      $states = [];
      foreach ($json as $key => $value) {
        $states[] = [
          "id"=>$value->id,
          "country_id"=>$value->country_id,
          "code"=>$value->iso2,
          "name_en"=>$value->name,
          "name_ar"=>$value->name,
        ];
        if(count($states)==500){
          State::insert($states);
          $states = [];
        }
      }
      if(count($states)){
        State::insert($states);
      }
    }
}
