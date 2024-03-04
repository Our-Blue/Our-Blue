<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'Tickets';
    protected $fillable = [
        'project_id',
        'title',
        'status',
        'user_id',
        'explanation',
        'start_day',
        'end_day',
        'limit_day',
        'time',
        'progress',
    ];

    // Ticket belongs to a Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Ticket belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function projects()
    {
    return $this->belongsTo(Project::class);/*（）の中は〇〇＿idの方良いと思うけど一旦これで*/
    }
}