<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadGeneration extends Model
{
    use HasFactory;

    public $table = 'lead_generation_customer';
    public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'customer_name',
    'phone',
    'location',
    'age',
    'gender',
    'income_level',
    'job_title',
    'industry',
    'email',
    'linkedin',
    'url'
  ];
}