@extends('admin.main', ['title' => 'Organisasi'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Organisasi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item active">Organisasi</li>
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
        <h3 class="card-title">Data Organisasi</h3>
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
                    <th style="width: 20%">
                    Nama Organisasi
                    </th>
                    <th style="width: 30%">
                    Penanggung Jawab
                    </th>
                    <th>
                    Nomor Telepon
                    </th>
                    <th style="width: 8%" class="text-center">
                    Status
                    </th>
                    <th style="width: 20%">
                    </th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($organizations as $organization)
                <tr>
                    <td>#</td>
                    <td>
                        <a>
                        {{ $organization->organization_name }}
                        </a>
                        <br />
                        <small>
                        Created {{ $organization->created_at->format('d.m.Y') }}
                        </small>                        
                    </td>
                    <td>
                        {{ $organization->PIC }}
                    </td>
                    <td>
                        {{ $organization->phone_number }}
                    </td>
                    <td class="project-state">
                        <span class="badge badge-success">{{ $organization->organization_status }}</span>
                    </td>
                    <td class="project-actions text-right">
                        <form action="{{ route('admin.organization.destroy',$organization->id) }}" method="POST">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.organization.show',$organization->id) }}">
                                <i class="fas fa-folder"></i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.organization.edit',$organization->id) }}">
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