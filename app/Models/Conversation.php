<?php

namespace App\Models;

class Conversation extends Models
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['channel_id', 'session_id', 'title', 'lead_id', 'status'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'channel_id' => 'integer',
    'session_id' => 'integer',
    'title' => 'string',
    'lead_id' => 'integer',
    'status' => 'string',
  ];
}
