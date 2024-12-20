<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'description', 
        'type', 
        'province', 
        'regency', 
        'subdistrict', 
        'village', 
        'voting', 
        'viewers', 
        'image', 
        'statement'
    ];

    public function comment()
    {
        return $this->hasMany(Comment::class, 'id', 'report_id');
    }

    public function response()
    {
        return $this->hasOne(Response::class, 'id', 'report_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
