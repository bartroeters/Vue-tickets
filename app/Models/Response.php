<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'content'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }
}
