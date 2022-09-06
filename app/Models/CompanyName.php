<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyName extends Model
{
    use HasFactory;

    /*public function users(){
        $this->belongsTo(CompanyName::class);
    }*/


    public function user(){
        return $this->hasMany(User::class, 'company_id');
    }

}
