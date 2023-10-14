<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersSessions extends Model
{
    use HasFactory;

    protected $table = 'users_sessions';
    protected $guarded = false;
    public $incrementing = false;
    public static string $secretKey = '977fea8deca4c2c2330544cf2e388284';
    protected $fillable = ['access_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
