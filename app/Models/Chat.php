<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'from',
    'to',
    'message',
    'conversation_id',
    'user_id',
    'participant_id',
    'dealer_id',
    'lead_id',
    'lead_is_verified',
    'status',
    'request_body',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   **/
  public function lead()
  {
    return $this->belongsTo(\App\Models\Lead::class, 'from', 'phone_number');
  }

  public function profile()
  {
    return $this->belongsTo(\App\Models\Profile::class, 'user_id');
  }


  public function dealer()
  {
    return $this->belongsTo(\App\Models\Dealer::class, 'dealer_id');
  }

}
