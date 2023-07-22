<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidencyProgramType extends Model
{
    use HasFactory;
    protected $table = 'residency_program_types';
    protected $fillable = [
        "dr_profile_id",
        "start_program",
        "type",
    ];
    // ================== Accessories ================
    public function getTypeAttribute($value)
    {
        if ($value == 0) {
            return 'Higher Education';
        } else {
            return 'Residency Program';
        }

    }
    // ================== Relationship ==================
    public function drProfile()
    {
      return $this->belongsTo(DrProfile::class, 'dr_profile_id');
    }
    public function residencyProgram()
    {
        return $this->hasMany(ResidancuProgram::class,'residency_program_type_id');
    }
    public function higherEducation()
    {
        return $this->hasMany(HigherEducation::class,'residency_program_type_id');
    }
}
