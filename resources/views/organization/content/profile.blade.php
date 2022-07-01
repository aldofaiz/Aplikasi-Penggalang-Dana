@extends('organization.main', ['title' => 'Profile'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('organization') }}">Organisasi</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">           
      <div class="card card-primary card-outline">        
        <div class="card-body box-profile">  
          <div class="text-center">
            <img class="img-fluid" src="{{ asset('storage/'.$organization->organization_logo) }}" alt="Organization Logo" width="100">
          </div>
          <h3 class="profile-username text-center">{{ $organization->organization_name }}</h3>
          <p class="text-muted text-center">Politeknik Elektronika Negeri Surabaya</p>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Program</b> <a class="float-right">{{ $count_program }}</a>
            </li>
          </ul>
          <a href="{{ route('organization.program.index') }}" class="btn btn-primary btn-block"><b>Program</b></a>
        </div>
      </div>  
  
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tentang Organisasi</h3>
        </div>
  
        <div class="card-body">
          <strong><i class="fas fa-book mr-1"></i> Education</strong>
          <p class="text-muted">
          Politeknik Elektronika Negeri Surabaya
          </p>
          <hr>
          <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
          <p class="text-muted">Jl. Raya ITS Sukolilo, PENS Campus</p>          
        </div>
      </div>  
    </div>
  
    <div class="col-md-9">
      @include('component.alert')
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#data" data-toggle="tab">Data</a></li>
            <li class="nav-item"><a class="nav-link" href="#update" data-toggle="tab">Update</a></li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">  
            <div class="active tab-pane" id="data">    
              <div class="form-group row">
                <label for="organization_name" class="col-sm-3 col-form-label">Nama Organisasi</label>
                <div class="col-sm-9">
                  <input type="text" disabled="disabled" class="form-control" value="{{ $organization->organization_name }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="PIC" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                <div class="col-sm-9">
                  <input type="text" disabled="disabled" class="form-control" value="{{ $organization->PIC }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="phone_number" class="col-sm-3 col-form-label">Nomor Telepon</label>
                <div class="col-sm-9">
                  <input type="text" disabled="disabled" class="form-control" value="{{ $organization->phone_number }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="rekening_number" class="col-sm-3 col-form-label">Nomor Rekening</label>
                <div class="col-sm-9">
                  <input type="text" disabled="disabled" class="form-control" value="{{ $organization->rekening_number }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="rekening_name" class="col-sm-3 col-form-label">Pemilik Rekening</label>
                <div class="col-sm-9">
                  <input type="text" disabled="disabled" class="form-control" value="{{ $organization->rekening_name }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="bank_name" class="col-sm-3 col-form-label">Bank</label>
                <div class="col-sm-9">
                  <input type="text" disabled="disabled" class="form-control" value="{{ $organization->bank_name }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="organization_status" class="col-sm-3 col-form-label">Status Organisasi</label>
                <div class="col-sm-9">
                  <input type="text" disabled="disabled" class="form-control" value="{{ $organization->organization_status }}">
                </div>
              </div>     
            </div>

            <div class="tab-pane" id="update">
              <form class="form-horizontal" action="{{ route('organization.profile.update',$organization->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label for="organization_name" class="col-sm-3 col-form-label">Nama Organisasi</label>
                  <div class="col-sm-9">
                    <input type="text" name="organization_name" class="form-control" value="{{ $organization->organization_name }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="organization_logo" class="col-sm-3 form-label">Logo Organisasi</label>
                  <div class="col-sm-4">
                      <div class="custom-file">
                      <input type="file" name="organization_logo" class="custom-file-input" id="organization_logo" accept="image/*">
                      <label class="custom-file-label" for="organization_logo">Choose file</label>
                      </div>                    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="PIC" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                  <div class="col-sm-9">
                    <input type="text" name="PIC" class="form-control" value="{{ $organization->PIC }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone_number" class="col-sm-3 col-form-label">Nomor Telepon</label>
                  <div class="col-sm-9">
                    <input type="text" name="phone_number" class="form-control" value="{{ $organization->phone_number }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="rekening_number" class="col-sm-3 col-form-label">Nomor Rekening</label>
                  <div class="col-sm-9">
                    <input type="text" name="rekening_number" class="form-control" value="{{ $organization->rekening_number }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="rekening_name" class="col-sm-3 col-form-label">Pemilik Rekening</label>
                  <div class="col-sm-9">
                    <input type="text" name="rekening_name" class="form-control" value="{{ $organization->rekening_name }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bank_name" class="col-sm-3 col-form-label">Bank</label>
                  <div class="col-sm-9">
                    <input type="text" name="bank_name" class="form-control" value="{{ $organization->bank_name }}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-3 col-sm-9">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </div>  
              </form>
            </div>  
          </div>    
        </div>
      </div>  
    </div>  
  </div>  
</div>

@endsection