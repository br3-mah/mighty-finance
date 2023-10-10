<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class References extends Model
{
    use HasFactory;
    protected $fillable = [
        'hrFname',
        'hrLname',
        'hrContactNumber',
        'supervisorFirstName',
        'supervisorLastName',
        'supervisorContactNumber',
        'user_id',
        'application_id'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }
}
