<?php

namespace App\Models;

class Channel extends Models
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['name', 'description'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'name' => 'string',
    'description' => 'string',
  ];
}
