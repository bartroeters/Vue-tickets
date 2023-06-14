<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'assigneeId',
        'statusId',
        'title',
        'content'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
