<?php

namespace JacobHyde\Tickets\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'phone', 'category_id', 'ticket_id', 'title', 'priority', 'message', 'status', 'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(config('tickets.user'));
    }
}
