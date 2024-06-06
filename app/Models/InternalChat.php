<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalChat extends Model
{
    use HasFactory;

    public $table = 'internal_chats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['message', 'type', 'media', 'status', 'from', 'to'];


    public function from()
    {
        return $this->belongsTo(\App\Models\Profile::class, 'from', 'id');
    }

    public function to()
    {
        return $this->belongsTo(\App\Models\Profile::class, 'to');
    }
}
