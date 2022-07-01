@extends('organization.main', ['title' => 'Dashboard'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('organization') }}">Organisasi</a></li>
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

    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $count_program }}</h3>
        <p>Program</p>
      </div>
      <div class="icon">
        <i class="fas fa-copy"></i>
      </div>
      <a href="{{ route('organization.program.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $count_program_withdraw }}</h3>
        <p>Pengajuan</p>
      </div>
      <div class="icon">
        <i class="fas fa-handshake"></i>
      </div>
      <a href="{{ route('organization.withdraw.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
      <div class="inner">
        <h3>@currency($withdraw)</h3>
        <p>Dana Diterima</p>
      </div>
      <div class="icon">
        <i class="fas fa-hand-holding-usd"></i>
      </div>
      <a href="{{ route('organization.withdraw.index') }}" class="small-box-footer">
        More info <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

</div>

@endsection