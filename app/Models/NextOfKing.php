<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextOfKing extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'fname',
        'lname',
        'phone',
        'address',
        'occupation',
        'nrc_no',
        'gender',
        'relation',
        'user_id'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }
}
