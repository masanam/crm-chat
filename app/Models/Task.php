<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
  use HasFactory;

  public $table = 'tasks';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'project_id',
    'client_id',
    'user_id',
    'status_id',
    'title',
    'deadline',
    'description',
    'priority',
    'code',
  ];

  public function client(): BelongsTo
  {
    return $this->belongsTo(Client::class);
  }

  public function status(): BelongsTo
  {
    return $this->belongsTo(TaskStatus::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(Profile::class);
  }
}
