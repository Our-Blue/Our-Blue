<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUser extends Model
{
    use HasFactory;

    protected $table = 'Users'; // テーブル名を指定（デフォルトの場合は 'users' テーブルと結びつきます）
    protected $primaryKey = 'ID'; // 主キーのカラム名を指定

    protected $fillable = [ // ホワイトリストとして許可するカラムを指定
        'name',
        'password',
        'mail',
        'role',
        // 他のカラムをここに追加
    ];
}