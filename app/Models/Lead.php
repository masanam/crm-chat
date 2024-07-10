<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function dealer()
  {
    return $this->belongsTo(Dealer::class);
  }

  public function assignedLead()
  {
    return $this->hasOne(AssignedLead::class);
  }
}
