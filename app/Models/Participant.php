<?php

namespace App\Models;

class Participant extends Models
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['user_id', 'conversation_id'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'user_id' => 'integer',
    'conversation_id' => 'integer',
  ];
}
