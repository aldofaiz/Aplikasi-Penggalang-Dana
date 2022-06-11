@extends('admin.main', ['title' => 'Akun'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item active">Akun</li>
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
        <h3 class="card-title">Data Akun</h3>
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
                    Nama
                    </th>
                    <th style="width: 30%">
                    Email
                    </th>
                    <th>
                    Role
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>#</td>
                    <td>
                        <a>
                        {{ $user->name }}
                        </a>
                        <br />
                        <small>
                        Created {{ $user->created_at->format('d.m.Y') }}
                        </small>                        
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->role_name }}
                    </td>
                    <td class="project-actions text-right">
                        <form action="{{ route('admin.account.destroy',$user->id) }}" method="POST">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.account.show',$user->id) }}">
                                <i class="fas fa-folder"></i>
                                View
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