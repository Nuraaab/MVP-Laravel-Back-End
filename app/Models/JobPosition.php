<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    use HasFactory;
    protected $fillable=[
        'job_title',
        'description',
        'location',
        'contact',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
      }
}
