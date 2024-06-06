<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaConversation extends Model
{
  use HasFactory;

  public $table = 'wa_conversations';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['client_id', 'to', 'session', 'template_name', 'type'];
}
