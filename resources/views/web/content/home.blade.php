@extends('web.app', ['title' => 'Beranda'])

@section('content')
<div class="container-fluid">
    <div class="p-3"></div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://cdn-1.timesmedia.co.id/images/2022/04/14/Gedung-PENS.jpg" class="d-block w-100 img-fluid" alt="..." style="max-height:620px;">
        </div>
        <div class="carousel-item">
            <img src="https://www.pens.ac.id/wp-content/uploads/2020/04/WhatsApp-Image-2020-04-16-at-13.32.40-1080x675.jpeg" class="d-block w-100 img-fluid" alt="..." style="max-height:620px;">
        </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>    
</div>

<div class="container">
    <!-- Program Berjalan -->
    @if(!$programs->isEmpty())
    <div class="row"> 
        <h1 class="fw-bold text-center mt-4">Program</h1>
    </div>
    <div class="row">
        @foreach ($programs as $program)
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 p-4">
            <div class="card-deck d-flex justify-content-center">        
                <div class="card w-100" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('storage/'.$program->program_poster) }}" height="300" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="height: 50px;">{{ $program->program_title }}</h5>
                    <div class="progress mb-2" style="height: 2px;">
                        <div class="progress-bar" style="width: @php
                        $collected = $program->donations->where('donation_status', 'success')->sum('amount');
                        $target =  $program->program_target_funds;
                        echo $collected / $target * 100;
                        @endphp%"></div>
                    </div>  
                    <div class="d-flex justify-content-between mb-3">
                        <div>Terkumpul</div>
                        <div>@currency($program->donations->where('donation_status', 'success')->sum('amount'))</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ url("/program/{$program->id}") }}" class="btn btn-primary">Mari Donasi</a>
                        <div>{{ Carbon\Carbon::parse($program->program_deadline)->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Terakhir diperbaharui {{ $program->updated_at->diffForHumans() }}</small>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row"> 
        <div class="col-12 d-flex justify-content-center">
        <a href="{{ route('program') }}" class="btn btn-primary text-center mt-3 mb-5">Cek Program Lainnya</a>
        </div>
    </div>
    @endif
    <!-- Program Berjalan -->

    <!-- Program Telaksana -->
    @if(!$programs_done->isEmpty())
    <div class="row border-top"> 
        <h1 class="fw-bold text-center mt-4">Program Terlaksana</h1>
    </div>
    <div class="row">   
        @foreach ($programs_done as $program_done)
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 p-4">
            <div class="card-deck d-flex justify-content-center">        
                <div class="card w-100" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('storage/'.$program_done->program_poster) }}" height="300" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="height: 50px;">{{ $program_done->program_title }}</h5>
                    <div class="progress mb-2" style="height: 2px;">
                        <div class="progress-bar" style="width: @php
                        $collected = $program_done->donations->where('donation_status', 'success')->sum('amount');
                        $target =  $program_done->program_target_funds;
                        echo $collected / $target * 100;
                        @endphp%"></div>
                    </div>  
                    <div class="d-flex justify-content-between mb-3">
                        <div>Terkumpul</div>
                        <div>@currency($program_done->donations->where('donation_status', 'success')->sum('amount'))</div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ url("/program/{$program_done->id}") }}" class="btn btn-primary">Lihat Program</a>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Terakhir diperbaharui {{ $program_done->updated_at->diffForHumans() }}</small>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row"> 
        <div class="col-12 d-flex justify-content-center">
        <a href="{{ route('program.done') }}" class="btn btn-primary text-center mt-3 mb-5">Cek Program Terlaksana Lainnya</a>
        </div>
    </div>
    @endif
    <!-- Program Telaksana -->

    <!-- Partner -->
    <div class="row border-top"> 
        <h1 class="fw-bold text-center mt-4">Partner Kami</h1>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            @foreach ($organizations as $organization)
            <div class="col-lg-1 col-md-6 col-sm-12 col-xs-12 p-4">
                <div class="w-100">
                    <img class="card-img-top" src="{{ asset('storage/'.$organization->organization_logo) }}" alt="Card image cap" style="max-height:100px;">
                </div>
            </div>
            @endforeach
        </div>       
    </div>
    <!-- Partner -->
</div>


@endsection