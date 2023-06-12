<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
