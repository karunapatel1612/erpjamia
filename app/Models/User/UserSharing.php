<?php

namespace App\Models\User;

use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\AdmissionSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSharing extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'vertical_id',
    'admission_session_id',
    'start_date'
  ];

  protected $table = 'user_sharings';

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function vertical()
  {
    return $this->belongsTo(Vertical::class);
  }

  public function admissionSession()
  {
    return $this->belongsTo(AdmissionSession::class);
  }

  public function sharingFees()
  {
    return $this->hasMany(UserSharingFee::class);
  }
}
