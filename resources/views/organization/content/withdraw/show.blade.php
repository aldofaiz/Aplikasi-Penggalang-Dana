@extends('organization.main', ['title' => 'Program'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detail Program</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('organization') }}">Organisasi</a></li>
          <li class="breadcrumb-item"><a href="{{ route('organization.program.index') }}">Program</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<br />
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail</h3>
    </div>
    
    <div class="card-body p-0">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th style="width: 20%">Judul Program</th>
                    <td>
                        {{ $program->program_title }}
                    </td>
                </tr>
                <tr>
                    <th>Created_at</th>
                    <td>
                        {{ $program->created_at->diffForHumans() }}
                    </td>
                </tr> 
                <tr>
                    <th>Updated_at</th>
                    <td>
                        {{ $program->updated_at->diffForHumans() }}
                    </td>
                </tr>               
            </tbody>
        </table>
    </div>    
</div>
@endsection

@push('css')    
@endpush

@push('js')    
@endpush