<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public function usuarios() {
        return $this->belongsToMany(Usuario::class);
    }
}
