<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'game_id',
        'owner',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'parties_users');
    }

    public function message()
    {
        return $this->hasMany(Message::class, 'party_id');
    }
}
