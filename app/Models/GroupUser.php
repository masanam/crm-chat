<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupUser extends Model
{
    use HasFactory;
    protected $fillable=[
        "group_id",
        "user_id"
    ];

    /**
     * Get all of the users for the GroupUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class,'id','user_id');
    }
}
