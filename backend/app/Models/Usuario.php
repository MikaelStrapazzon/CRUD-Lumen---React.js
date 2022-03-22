<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function empresas() {
        return $this->belongsToMany('App\Models\Empresa');
    }
}
