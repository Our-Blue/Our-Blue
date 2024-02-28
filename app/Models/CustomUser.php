<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Passwords\CanResetPassword;

class CustomUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Users'; // テーブル名を指定（デフォルトの場合は 'users' テーブルと結びつきます）
    protected $primaryKey = 'ID'; // 主キーのカラム名を指定

    protected $fillable = [ // ホワイトリストとして許可するカラムを指定
        'name',
        'password',
        'mail',
        'role',
        // 他のカラムをここに追加
    ];
    
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'members', 'user_id', 'project_id');
    }
}

