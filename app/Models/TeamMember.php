<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
  use HasFactory;

  public $table = 'team_members';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['team_id', 'user_id', 'status'];
  
  
  public function profile()
  {
    return $this->belongsTo(\App\Models\Profile::class, 'user_id', 'id');
  }
}
