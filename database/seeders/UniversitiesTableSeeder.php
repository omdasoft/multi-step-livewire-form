<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\University;

class UniversitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = \File::get("database/data/universities.json");
      $json = json_decode($json);
      $universities = [];
      foreach ($json as $key => $value) {
        $universities[]=[
          "name_en"=>$value->name_en,
          "name_ar"=>$value->name_ar,
          "country_id"=>$value->country_id,
          "status"=>"0",
        ];

      }
      University::insert($universities);
    }
}
