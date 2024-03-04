<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'Projects';
    protected $primaryKey = 'ID';

    // モデルのフィールドとテーブルのカラムのマッピングを指定
    protected $fillable = [
        'admin',
        'title',
        'status',
        'explanation',
        'start_day',
        'end_day',
        'limit_day',
        'time',
        'progress',
        'created_at',
        'updated_at',
    ];
    
    public function users()
    {
        return $this->belongsToMany(CustomUser::class, 'members', 'project_id', 'user_id');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}