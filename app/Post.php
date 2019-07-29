<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'firstName', 'secondName', 'date_of_birth',  'gender', 'phoneNumber'
    ];

    protected $table = 'patients';
}
