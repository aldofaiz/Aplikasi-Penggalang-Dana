@extends('admin.main', ['title' => 'Withdraw'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pengajuan Penarikan Dana</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item active">Penarikan Dana</li>
          <li class="breadcrumb-item active">Pengajuan</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Program</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                    #
                    </th>
                    <th style="width: 23%">
                    Judul Program
                    </th>
                    <th style="width: 16%">
                    Organisasi
                    </th>
                    <th style="width: 16%">
                    Target Dana
                    </th>
                    <th>
                    Dana Terkumpul
                    </th>
                    <th style="width: 12%" class="text-center">
                    Status Penarikan
                    </th>
                    <th style="width: 12%">
                    </th>                   
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $program)
                <tr>
                    <td>#</td>
                    <td>
                        <a href="{{ route('admin.program.show',$program->id) }}">
                        {{ $program->program_title }}
                        </a>
                        <br />
                        <small>
                        Created {{ $program->created_at->format('d.m.Y') }}
                        </small>                        
                    </td>
                    <td>
                        <a href="{{ route('admin.organization.show',$program->organization->id) }}">
                            {{ $program->organization_name }}
                        </a>  
                    </td>
                    <td>
                        @currency($program->program_target_funds)
                    </td>
                    <td>
                        @currency($program->donations->where('donation_status', 'success')->sum('amount'))
                    </td>
                    <td class="project-state">
                        <span class="badge badge-warning">{{ $program->program_withdraw_status }}</span>
                    </td>
                    <td class="project-actions text-right">
                        <form action="{{ route('admin.withdraw.approved.update',$program->id) }}" method="POST">  
                          @csrf
                          @method('PUT')       
                            <button type="submit" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-marker"></i>
                                Setujui
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
</div>
@endsection