<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardType extends Model
{
    use HasFactory;
 
    protected $table = 'board_types';
    protected $fillable = [
      "name_ar",
      "name_en",
      "status",
    ];
    // ===========================================Accessories ===================================================
    public function getStatusAttribute($value)
    {
        if ($value == 0) {
            return 'Active';
        } elseif ($value == 1) {
            return 'Inactive';
        }
    }
    // =========================================== Relationship ===================================================
    public function board()
    {
        $this->hasMany(Board::class,'board_type_id');
    }
}
