@extends('web.app', ['title' => 'Program'])

@section('content')
<div class="container">
    <!-- Program Berjalan -->
    <div class="row"> 
        <h1 class="fw-bold text-center mt-5">Program</h1>
    </div>
    <div class="row">
        @forelse($programs as $program)
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
        @empty
        <div class="card-deck d-flex justify-content-center">
            <div class="p-5">
                <div class="p-4">
                    <h5 class="mt-3 mb-5 p-5">Tidak Ada Program Saat ini</h5>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    <div class="row"> 
        <div class="col-12 d-flex justify-content-center">
            {!! $programs->links() !!}
        </div>
    </div>
    <!-- Program Berjalan -->
</div>
@endsection