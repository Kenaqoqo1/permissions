<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $fillable = [
      'firstName', 'secondName', 'date_of_birth',  'gender', 'phoneNumber'
    ];

    protected $table = 'patients';
    protected $primaryKey='patientid';

    public function appointment() {
      return $this->hasMany(Appointment::class, 'patient_id','patientid');
    }
}
