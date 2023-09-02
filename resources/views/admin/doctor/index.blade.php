@extends('layouts.backend.index')
@section('title', 'Doctors')

@section('content')

<div class="container-fluid">
    <div class="row">
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-header justify-content-between">
                <div class="row pt-3">
                    <div class="col-sm-6">
                        <div class="iq-header-title">
                            <h4 class="card-title">Doctors</h4>
                         </div>
                    </div>
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary float-end">
                            <i class="fa-solid fa-plus"></i> New Doctor
                        </a>
                    </div>
                </div>
             </div>
             <div class="iq-card-body">
                <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p>
                <div class="table-responsive">
                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                         <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE NUMBER</th>
                            <th>ALT PHONE NUMBER</th>
                            <th>HOME ADDRESS</th>
                            <th>GENDER</th>
                            <th>EDIT</th>
                            <th>VIEW</th>
                         </tr>
                      </thead>
                      <tbody>
                            @forelse ($doctors as $key=>$doctor)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ Str::title($doctor->users->name) }}</td>
                                    <td><a href="mailto:{{ $doctor->users->email }}">{{ $doctor->users->email }}</a></td>
                                    <td>{{ $doctor->phone_no }}</td>
                                    <td>{{ $doctor->alt_phone_no }}</td>
                                    <td>{{ $doctor->street_address }}</td>
                                    <td>{{ $doctor->gender? 'Female' : 'Male' }}</td>
                                    <td>
                                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-primary float-end">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.doctors.show', $doctor->id) }}" class="btn btn-primary">
                                            <i class="fa-regular fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                    {{-- <tr>
                                        <td colspan="4">No Session added</td>
                                    </tr> --}}
                            @endforelse
                      </tbody>
                      <tfoot>
                         <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE NUMBER</th>
                            <th>ALT PHONE NUMBER</th>
                            <th>HOME ADDRESS</th>
                            <th>GENDER</th>
                            <th>EDIT</th>
                            <th>VIEW</th>
                         </tr>
                      </tfoot>
                   </table>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

@endsection
