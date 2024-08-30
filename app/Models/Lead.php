<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Stage;

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

  public function contacts()
  {
    return $this->hasMany(Contact::class);
  }

  public function phase()
  {
      return $this->belongsTo(Stage::class,'stage','id');
  }

}
