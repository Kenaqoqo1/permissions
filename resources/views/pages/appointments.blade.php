@extends('layouts.app')
@section('content')
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Hospital</title>
    </head>
    <body>
            <div class="table-responsive">
              <table class="table table-striped table-hover table-condensed">
                <thead>
                  <tr>
                    <th><strong>Appointment Number</strong></th>
                    <th><strong>Patient ID</strong></th>
                    <th><strong>Name</strong></th>
                    <th><strong>Gender</strong></th>
                    <th><strong>Date</strong></th>
                    <th><strong>Time</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($appointments as $appointments)
                    <tr>
                      <td>{{$appointments->appointment_number}}</td>
                      <td>{{$appointments->patient_id}}</td>
                      <td>{{$appointments->patient->firstName . ' ' . $appointments->patient->secondName}}</td>
                      <td>{{$appointments->gender}}</td>
                      <td>{{$appointments->date}}</td>
                      <td>{{$appointments->time}}</td>
                      <td><button class="btn btn-primary" type="submit" name="button"data-toggle="modal" data-target="#editModal{{$appointments->appointment_number}}">Edit</button></td>
                      <td><button class="btn btn-danger"type="submit" name="button"data-toggle="modal" data-target="#deleteModal{{$appointments->appointment_number}}">Delete</button></td>
                      <div class="modal fade" id="deleteModal{{$appointments->appointment_number}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Confirm Action</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                              <form action="{{ route('patient.destroy', ['patient' => $appointments->appointment_number ])}}" method="post" id="deleteModal">
                                {{ csrf_field() }}
                                 {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" >Yes</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="editModal{{$appointments->appointment_number}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Edit Appointments</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="{{ route('appointment.update', ['appointment' => $appointments->appointment_number]) }}">
                                @csrf
                                {{ method_field('PATCH') }}
                                <label for="date">Date:</label>
                                <input type="date" required class="form-control" id="date" name="date" value="{{$appointments->date}}">
                                <label for="time">Time</label>
                                <input type="time" name="time" value="{{$appointments->time}}">

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">submit</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </tr>
          @endforeach
        </tbody>
      </table>
    </div>
      </body>
  </html>
@endsection
