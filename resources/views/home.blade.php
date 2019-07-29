@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                      <div class="row">
                        <div class="col-md-2">
                          <div class="">
                            <a href="/registers" type="button" style="cursor:pointer" class="btn btn-primary">Register</a>

                          </div>

                        </div>

                          <div class="col-md-2">
                            <div class="row">
                            <a href="/appointments" type="button" style="cursor:pointer" class="btn btn-primary">Appointment</a>
                          </div>
                        </div>
                          <div class="col-md-2">
                            <div class="">

                              <a href="/patients" type="button" style="cursor:pointer" class="btn btn-primary">Patients</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                          <div class="">

                            <a href="/patients" type="button" style="cursor:pointer" class="btn btn-primary">Patients</a>
                          </div>
                      </div>
                        <div class="col-md-2">
                          <div class="row">
                            <a href="/schedule" type="button" style="cursor:pointer" class="btn btn-primary">Schedule</a>
                          </div>
                      </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
