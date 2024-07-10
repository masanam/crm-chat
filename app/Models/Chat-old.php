<?php

namespace App\Models;

class Chat extends Models
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['from', 'to', 'message', 'conversation_id', 'user_id', 'participant_id', 'status'];

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
    'status' => 'string',
  ];
}
