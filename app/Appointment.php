<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
  protected $fillable = [
    'patient_id', 'gender', 'date', 'time'
  ];

  protected $primaryKey = 'appointment_number';

  public function patient() {
    return $this->belongsTo(Patients::class, 'patient_id','patientid');
  }
}
