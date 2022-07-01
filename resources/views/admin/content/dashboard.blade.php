@extends('admin.main', ['title' => 'Dashboard'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<h5 class="mb-2 mt-4">Recap</h5>
<div class="row">
  <div class="col-lg-3 col-6">

    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $category_count }}</h3>
        <p>Kategori</p>
      </div>
      <div class="icon">
        <i class="fas fa-paperclip"></i>
      </div>
      <a href="{{ route('admin.category.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $program_count }}</h3>
        <p>Program</p>
      </div>
      <div class="icon">
        <i class="fas fa-copy"></i>
      </div>
      <a href="{{ route('admin.program.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $program_submission_count }}</h3>
        <p>Pengajuan</p>
      </div>
      <div class="icon">
        <i class="fas fa-business-time"></i>
      </div>
      <a href="{{ route('admin.withdraw.submission') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $organization_pending_count }}</h3>
        <p>Organisasi Pending</p>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
      <a href="{{ route('admin.organization.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>  

</div>

@endsection