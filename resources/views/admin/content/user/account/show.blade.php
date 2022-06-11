@extends('admin.main', ['title' => 'Akun'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detail Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.account.index') }}">Akun</a></li>
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
                    <th style="width: 20%">Nama</th>
                    <td>
                        {{ $user->name }}
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>
                        {{ $role->role_name }}
                    </td>
                </tr>
                <tr>
                    <th>Created_at</th>
                    <td>
                        {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                    </td>
                </tr> 
                <tr>
                    <th>Updated_at</th>
                    <td>
                        {{ Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}
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