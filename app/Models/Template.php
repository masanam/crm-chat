<?php

namespace App\Models;

class Template extends Models
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['channel_id', 'name', 'description', 'message', 'attachment', 'status'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'channel_id' => 'integer',
    'name' => 'string',
    'description' => 'string',
    'message' => 'string',
    'attachment' => 'string',
    'status' => 'string',
  ];
}
