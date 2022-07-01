@extends('organization.main', ['title' => 'Withdraw'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Penarikan Dana</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('organization') }}">Organisasi</a></li>
          <li class="breadcrumb-item active">Penarikan Dana</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')

<div class="row">
    <div class="col-12">
    <a href="{{ route('organization.withdraw.create') }}" class="btn btn-primary">Buat Pengajuan</a>
    </div>
</div>
<br />
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Penarikan Dana</h3>
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
                    <th style="width: 25%">
                    Judul Program
                    </th>
                    <th style="width: 20%">
                    Deadline 
                    </th>  
                    <th style="width: 20%">
                    Target Dana
                    </th>
                    <th>
                    Dana Terkumpul
                    </th>
                    <th style="width: 15%" class="text-center">
                    Status Penarikan
                    </th>                                     
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $program)
                <tr>
                    <td>#</td>
                    <td>
                        <a href="{{ route('organization.program.show',$program->id) }}">
                        {{ $program->program_title }}
                        </a>
                        <br />
                        <small>
                        Created {{ $program->created_at->format('d.m.Y') }}
                        </small>                        
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($program->program_deadline)->format('d M Y') }}
                    </td>
                    <td>
                        @currency($program->program_target_funds)
                    </td>
                    <td>
                        @currency($program->donations->where('donation_status', 'success')->sum('amount'))
                    </td>
                    <td class="project-state">
                        @if($program->program_withdraw_status == "none")
                        <span class="badge badge-dark">{{ $program->program_withdraw_status }}</span>
                        @elseif($program->program_withdraw_status == "submission")
                        <span class="badge badge-warning">{{ $program->program_withdraw_status }}</span>
                        @elseif($program->program_withdraw_status == "approved")
                        <span class="badge badge-info">{{ $program->program_withdraw_status }}</span>
                        @elseif($program->program_withdraw_status == "finished")
                        <span class="badge badge-success">{{ $program->program_withdraw_status }}</span>
                        @endif 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
</div>


@endsection