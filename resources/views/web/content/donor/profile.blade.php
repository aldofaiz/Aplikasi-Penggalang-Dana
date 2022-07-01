@extends('web.app', ['title' => 'Profile'])

@section('content')
<div class="container">
    <div class="row flex-lg-nowrap mt-5">
        <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
            <div class="card p-3">
                <div class="e-navlist e-navlist--active-bg">
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link px-2 active" href="{{ route('donor.profile') }}"><span>Setting</span></a></li>
                        <li class="nav-item"><a class="nav-link px-2" href="{{ route('donor.data.donation') }}"><span>Donasi Anda</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
      
        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="e-profile">
                                <div class="row">
                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-5">
                                        <div class="text-left text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name }}</h4>
                                            <p class="mb-0">{{ $donor->phone_number }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @include('component.alert')
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                                </ul>
                                <div class="tab-content pt-3">
                                    <div class="tab-pane active">
                                        <form class="form" action="{{ route('donor.profile.update') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Nama Lengkap</label>
                                                                <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <div class="form-group">
                                                                <label>Nomor Telepon</label>
                                                                <input class="form-control" type="text" name="phone_number" value="{{ $donor->phone_number }}">
                                                            </div>
                                                        </div>
                                                    </div>                    
                                                </div>
                                            </div>                          
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection