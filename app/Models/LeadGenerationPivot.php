<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadGenerationPivot extends Model
{
    use HasFactory;

    public $table = 'lead_generation';
    public $timestamps = false;

    /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'lead_gen_customer_id',
    'lead_gen_list_id'
  ];
}
