@extends('organization.main', ['title' => 'Pengajuan'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pengajuan Penarikan Dana</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('organization') }}">Organisasi</a></li>
          <li class="breadcrumb-item"><a href="{{ route('organization.withdraw.index') }}">Penarikan Dana</a></li>
          <li class="breadcrumb-item active">Pengajuan</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Pengajuan</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <form action="{{ route('organization.withdraw.submission') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Program</label>
                        <select name="id" class="form-control custom-select">
                            <option selected disabled>Select one</option>
                            @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->program_title }}</option>
                            @endforeach
                        </select>
                    </div>                          
                </div>            
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Ajukan Penarikan Dana" class="btn btn-success float-right">
                </div>
            </div>     
        </div>
    </form>
    
    <div class="card-footer">
    Pengajuan Penarikan Dana hanya dapat dilakukan oleh Organisasi.
    </div>
</div>
@endsection