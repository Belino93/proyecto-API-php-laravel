<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'genre',
        'developed',
        'user_id',
    ];

    public function game()
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
