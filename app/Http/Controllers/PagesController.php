<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Post;
use DB;

class PagesController extends Controller
{
    //

    public function appointment()
    {
      $appointments = Appointment::with('patient')->get();
        //$appointments = new Appointment;
         // return dd($appointments);


        return view('pages.appointments', compact('appointments'));
    }

    public function schedule()
    {
        return view('pages.schedule');
    }

    public function register()
    {
        return view('pages.registers');
    }
    public function patients()
    {
      $patients = Post::all();

      return view('pages.patients', compact('patients'));
    }

    public function create_appointment(){
      $id = request('patientid');
      $patient = DB:: table('patients') ->where('patientid', '=', $id)->value('gender');
      $date = request('date');
      $time = request('time');

      Appointment::create([
        'patient_id' => $id,
        'gender' => $patient,
        'date' => $date,
        'time' => $time
      ]);

      return redirect()->back();
    }
}
