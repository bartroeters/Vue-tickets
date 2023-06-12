<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }
}
