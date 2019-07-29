@extends('layouts.app')
@section('content')

@if ($errors->count() != 0)
  @include('errors')
@endif


  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                  <div class="card-body">
                      <h2>Register</h2>
                        <form method="POST" action="{{ route('post.store') }}">
                          @csrf
                            <div class="form-inline">
                                <label for="firstName">First Name:</label>
                                <input type="text" required class="form-control" id="firstName" name="firstName" placeholder="First Name">
                                <label for="secondName">Second Name:</label>
                                <input type="text" required class="form-control" id="secondName" name="secondName" placeholder="Second Name" >
                                </div><br>
                            <div class="form-inline">
                              <label for="date_of_birth">Date of Birth:</label>
                              <input type="date" required class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth">
                              <label for="gender">Gender:</label>
                                <select class="form-control" required name="gender">
                                       <option value="Male">Male</option>
                                       <option value="Female">Female</option>
                                </select>
                            </div> <br>
                                <label for="phoneNumber">Phone Number</label>
                                <input type="integer" required class="form-control" id="phoneWork" name="phoneNumber" placeholder="Phone Number">
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
@endsection
