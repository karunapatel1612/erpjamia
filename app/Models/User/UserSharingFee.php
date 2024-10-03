<?php

namespace App\Models\User;

use App\Models\Academics\Specialization;
use App\Models\Settings\Admissions\FeeStructure;
use App\Models\Settings\Admissions\Scheme;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSharingFee extends Model
{
  use HasFactory;

  protected $table = 'user_sharing_fees';

  protected $fillable = [
    'user_sharing_id',
    'scheme_id',
    'specialization_id',
    'fee_structure_id',
    'duration',
    'fee_type',
    'fee',
  ];

  public function scheme()
  {
    return $this->belongsTo(Scheme::class);
  }

  public function userSharing()
  {
    return $this->belongsTo(UserSharing::class);
  }

  public function specialization()
  {
    return $this->belongsTo(Specialization::class);
  }

  public function feeStructure()
  {
    return $this->belongsTo(FeeStructure::class);
  }
}
