<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'project_id'];

    // Members テーブルに対応することを明示
    protected $table = 'Members';
    
    // 自動タイムスタンプ機能を無効にする
    public $timestamps = false;

    // 他のモデルとの関連を定義する
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
