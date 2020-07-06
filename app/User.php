<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Uuid;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'level'
    ];

    public function changeLevel($action)
    {
        $level =  $action == 'upgrade' ? 'P' : 'F';
        $this->level = $level;
        $this->save();
        return $this;
    }
}
