<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  use HasFactory;

  public $table = 'clients';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['organization_id', 'name', 'email', 'phone', 'meta_business', 'wa_business', 'quota', 'session_service', 'counter_service'];
}
