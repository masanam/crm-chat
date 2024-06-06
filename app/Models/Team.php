<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
  use HasFactory;

  public $table = 'teams';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['name', 'client_id', 'description'];
  
  
  public function members()
  {
    return $this->HasMany(\App\Models\TeamMember::class);
  }
}
