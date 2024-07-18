<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  use HasFactory;

  protected $fillable = ['client_id', 'first_name', 'last_name', 'job_title', 'whatsapp', 'email', 'created_by'];

  /**
   * Get the client that owns the Contact
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function client(): BelongsTo
  {
    return $this->belongsTo(Client::class);
  }
}
