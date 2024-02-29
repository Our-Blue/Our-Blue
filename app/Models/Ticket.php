<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
use HasFactory;
protected $table = 'Tickets';
protected $primaryKey = 'ID';

// モデルのフィールドとテーブルのカラムのマッピングを指定
protected $fillable = [
'id',
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
'created_at',
'updated_at',
];

    public function projects()
    {
    return $this->belongsTo(Project::class);
    }
}