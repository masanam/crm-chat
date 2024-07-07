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
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'from' => 'string',
    'to' => 'string',
    'message' => 'string',
    'conversation_id' => 'integer',
    'user_id' => 'integer',
    'participant_id' => 'integer',
    'dealer_id' => 'integer',
    'lead_id' => 'integer',
    'lead_is_verified' => 'string',
    'status' => 'string',
    'request_body' => 'string',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   **/
  public function lead()
  {
    return $this->belongsTo(\App\Models\Lead::class, 'from', 'phone_number');
  }
}
