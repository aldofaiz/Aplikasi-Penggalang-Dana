@extends('organization.main', ['title' => 'Program'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Program</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('organization') }}">Organisasi</a></li>
          <li class="breadcrumb-item active">Program</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')

<div class="row">
    <div class="col-12">
    <a href="{{ route('organization.program.create') }}" class="btn btn-primary">Tambah Program</a>
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
                    <th style="width: 30%">
                    Judul Program
                    </th>
                    <th style="width: 20%">
                    Target Pendanaan
                    </th>
                    <th>
                    Deadline Program
                    </th>
                    <th style="width: 8%" class="text-center">
                    Status
                    </th>
                    <th style="width: 20%">
                    </th>                   
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $program)
                <tr>
                    <td>#</td>
                    <td>
                        <a>
                        {{ $program->program_title }}
                        </a>
                        <br />
                        <small>
                        Created {{ $program->created_at->format('d.m.Y') }}
                        </small>                        
                    </td>
                    <td>
                        Rp {{ $program->program_target_funds }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($program->program_deadline)->format('d M Y') }}
                    </td>
                    <td class="project-state">
                        <span class="badge badge-success">{{ $program->program_status }}</span>
                    </td>
                    <td class="project-actions text-right">
                        <form action="{{ route('organization.program.destroy',$program->id) }}" method="POST">
                            <a class="btn btn-primary btn-sm" href="{{ route('organization.program.show',$program->id) }}">
                                <i class="fas fa-folder"></i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('organization.program.edit',$program->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>        
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                                Delete
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