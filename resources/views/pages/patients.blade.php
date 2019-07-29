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
            <th><strong>Patient Number</strong></th>
            <th><strong>First Name</strong></th>
            <th><strong>Second Name</strong></th>
            <th><strong>Gender</strong></th>
            <th><strong>Date of birth</strong></th>
            <th><strong>Phone Number</strong></th>
            <th><strong>Appointment</strong></th>
            <th><strong>Edit</strong></th>
            <th><strong>Delete</strong></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($patients as $patient)
            <tr>
              <td>{{ $patient->patientid }}</td>
              <td>{{ $patient->firstName }}</td>
              <td>{{ $patient->secondName }}</td>
              <td>{{ $patient->gender }}</td>
              <td>{{ $patient->date_of_birth }}</td>
              <td> {{ $patient->phoneNumber }}</td>
        <td><button class="btn btn-success" type="submit" name="button" data-toggle="modal" data-target="#appointment{{ $patient->patientid }}">Appointment</button></td>
            <div class="modal fade" id="appointment{{ $patient->patientid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Appointments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <div class="row justify-content-center">
                          <div class="col-md-8">
                              <div class="card">
                                  {{-- <div class="card-header">Edit Patients</div> --}}
                                    <div class="card-body">
                                          <form method="POST" action="{{ route('create_appointments') }}">
                                            @csrf
                                            <input type="hidden" name="patientid" value="{{ $patient->patientid }}">

                                              <div class="form-inline">
                                                  <label for="date">Date:</label>
                                                  <input type="Date" required class="form-control" id="date" name="date" value="">
                                                </div> <br>
                                                  <div class="form-inline">
                                                  <label for="time">Time:</label>
                                                    <input type="time" required class="form-control" id="time" name="time" value="" >
                                                  <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Submit</button>

                                                  </div>
                                                  </div>
                                          </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  </div>
                  {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <form action="" method="post" id="deleteModal">
                    <button type="button" class="btn btn-primary" >Yes</button>
                    </form>
                  </div> --}}
                </div>
              </div>
            </div>
                {{-- </form> --}}
              </td>
              <td><button class="btn btn-primary" type="submit" name="button"data-toggle="modal" data-target="#editModal{{ $patient->patientid }}">Edit</button></td>

              <td><button class="btn btn-danger"type="submit" name="button"data-toggle="modal" data-target="#deleteModal{{ $patient->patientid }}">Delete</button></td>
              <!-- Modal -->

              <div class="modal fade" id="deleteModal{{ $patient->patientid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <form action="{{route('patients.delete', ['delete'=> $patient->patientid])}}" method="post" id="deleteModal">
                        {{ csrf_field() }}
                        {{method_field('delete')}}
                      <button type="submit" class="btn btn-danger" >Yes</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="editModal{{ $patient->patientid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Patients</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    {{-- <div class="card-header">Edit Patients</div> --}}
                                      <div class="card-body">
                                            <form method="POST" action="{{ route('patient.update', ['patient' => $patient->patientid]) }}">
                                              @csrf
                                              {{ method_field('PATCH') }}
                                                <div class="form-inline">
                                                    <label for="firstName">First Name:</label>
                                                    <input type="text" required class="form-control" id="firstName" name="firstName" value="{{ $patient->firstName }}">
                                                  </div> <br>
                                                    <div class="form-inline">
                                                    <label for="secondName">Second Name:</label>
                                                    <input type="text" required class="form-control" id="secondName" name="secondName" value="{{ $patient->secondName }}" >
                                                    </div><br>
                                                <div class="form-inline">
                                                  <label for="date_of_birth">Date of Birth:</label>
                                                  <input type="date" required class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $patient->date_of_birth }}">
                                                </div><br>
                                                  <div class="form-inline">
                                                  <label for="gender">Gender:</label>
                                                    <select class="form-control" required name="gender">
                                                           <option value="Male">Male</option>
                                                           <option value="Female">Female</option>
                                                    </select>
                                                </div> <br>
                                                    <label for="phoneNumber">Phone Number</label>
                                                    <input type="integer" required class="form-control" id="phoneWork" name="phoneNumber" Value="{{ $patient->phoneNumber }}">
                                                </div><br>
                                                <div class="form-group">
                                                    <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    {{-- <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <form action="" method="post" id="deleteModal">
                      <button type="button" class="btn btn-primary" >Yes</button>
                      </form>
                    </div> --}}
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
