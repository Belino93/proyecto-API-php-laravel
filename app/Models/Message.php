<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'party_id',
        'user_id',
        'content',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
