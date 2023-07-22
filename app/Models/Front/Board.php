<?php

namespace App\Models\Front;
use App\Models\Admin\BoardType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;    
    protected $table = 'boards';
    protected $fillable = [
      "dr_profile_id",
      "board_question",
      "board_type_id",
      "board_scan",

    ];
    // =========== Accessories ===========

    // =========== Relationship ==========
    public function drProfile()
    {
      return $this->belongsTo(DrProfile::class, 'dr_profile_id');
    }
    public function boardType()
    {
      return $this->belongsTo(BoardType::class, 'board_type_id');
    }
}