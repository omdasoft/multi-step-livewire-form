<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

  public static function getAll()
  {
    return cache()->rememberForever('nationalities.all', function () {
      return self::orderBy('nationality')->get();
    });
  }
}
