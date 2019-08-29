<?php
namespace App;
//use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens; // 追加
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $guarded = ['ip','host','black','payjp'];
}
