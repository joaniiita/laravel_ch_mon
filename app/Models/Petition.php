<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $table = 'petitions';

    protected $fillable = [
        'titulo',
        'descripcion',
        'destinatario',
        'firmantes',
        'estado',
        'image',
    ];

    protected $hidden = [
        'user_id',
        'categoria_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function signers(){
        return $this->belongsToMany(User::class, 'petition_user');
    }

    public function files(){
        return $this->hasMany(File::class);
    }
}
