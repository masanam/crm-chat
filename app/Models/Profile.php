<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  use HasFactory;

  public $table = 'profiles';

  protected $keyType = 'string';
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'first_name',
    'last_name',
    'role',
    'dealer_id',
    'team_id',
    'email',
    'client_id',
    'job_title',
  ];

  public function dealer()
  {
    return $this->belongsTo(Dealer::class);
  }
}
