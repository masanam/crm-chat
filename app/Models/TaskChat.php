<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskChat extends Model
{
  use HasFactory;

  protected $fillable = ['message', 'task_id', 'created_by'];

  /**
   * Get the task that owns the TaskChat
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function task(): HasOne
  {
    return $this->hasOne(Task::class);
  }

  /**
   * Get the profile that owns the TaskChat
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function profile(): BelongsTo
  {
    return $this->belongsTo(Profile::class, 'created_by', 'id');
  }
}
