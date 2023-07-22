<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\BoardType;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $json = \File::get("database/data/boards.json");
      $json = json_decode($json);
      $sectors = [];
      foreach ($json as $key => $value) {
        $sectors[]=[
          "name_en"=>$value->name_en,
          "name_ar"=>$value->name_ar,
          "status"=>$value->status,
        ];

      }
      BoardType::insert($sectors);
    }
}
