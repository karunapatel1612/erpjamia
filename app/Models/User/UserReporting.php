<?php

namespace App\Models\User;

use App\Models\Academics\Vertical;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReporting extends Model
{
  use HasFactory;

  protected $fillable = ['user_id', 'vertical_id', 'parent_id'];

  // Relationships

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function vertical()
  {
    return $this->belongsTo(Vertical::class, 'vertical_id');
  }

  public function parent()
  {
    return $this->belongsTo(User::class, 'parent_id');
  }
}
