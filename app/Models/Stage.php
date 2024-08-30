<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Stage extends Model
{
  use HasFactory;
  
  public $table = 'stages';

  protected $fillable = ['name'];
}
