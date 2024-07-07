<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
  use HasFactory;

  public $table = 'clients';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'organization_id',
    'name',
    'email',
    'phone',
    'meta_business',
    'wa_business',
    'quota',
    'session_service',
    'counter_service',
  ];

  public function organization(): HasOne
  {
    return $this->hasOne(Organization::class, 'id', 'organization_id');
  }

  /**
   * Get all of the contacts for the Client
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function contacts(): HasMany
  {
    return $this->hasMany(Contact::class, 'client_id', 'id');
  }
}
