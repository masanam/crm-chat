<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
  use HasFactory;

  public $table = 'dealers';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'package',
    'due_date',
    'business_phone',
    'wa_account_phone_number_id',
    'wa_account_token',
    'meta_business',
    'wa_business',
  ];
}
