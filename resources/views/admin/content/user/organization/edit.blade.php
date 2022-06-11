@extends('admin.main', ['title' => 'Organisasi'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Organisasi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.organization.index') }}">Organisasi</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Edit</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <form action="{{ route('admin.organization.update',$organization->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Organisasi</label>
                        <input type="text" name="organization_name" value="{{ $organization->organization_name }}" class="form-control" readonly>
                    </div>   
                    <div class="form-group">
                        <label>Penanggung Jawab</label>
                        <input type="text" name="PIC" value="{{ $organization->PIC }}" class="form-control" readonly>
                    </div>   
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="phone_number" value="{{ $organization->phone_number }}" class="form-control" readonly>
                    </div>   
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" name="rekening_number" value="{{ $organization->rekening_number }}" class="form-control" readonly>
                    </div>   
                    <div class="form-group">
                        <label>Pemilik Rekening</label>
                        <input type="text" name="rekening_name" value="{{ $organization->rekening_name }}" class="form-control" readonly>
                    </div>   
                    <div class="form-group">
                        <label>Bank</label>
                        <input type="text" name="bank_name" value="{{ $organization->bank_name }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status Organisasi</label>
                        <select name="organization_status" class="form-control custom-select" style="width: 100%;">
                            <option value="active" {{ ( $organization->organization_status == "active") ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ ( $organization->organization_status == "pending") ? 'selected' : '' }}>Pending</option>
                            <option value="nonactive" {{ ( $organization->organization_status == "nonactive") ? 'selected' : '' }}>Nonactive</option>
                            <option value="blacklist" {{ ( $organization->organization_status == "blacklist") ? 'selected' : '' }}>Blacklist</option>
                        </select>
                    </div>        
                </div>            
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Edit Organisasi" class="btn btn-success float-right">
                </div>
            </div>     
        </div>
    </form>
    
    <div class="card-footer">
    </div>
</div>

@endsection