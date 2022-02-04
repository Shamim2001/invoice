<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    use HasFactory;

    // protected $fillable = ['name', 'username'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function tasks() {
        return $this->hasMany( Task::class, 'client_id', 'id' );
    }

}
