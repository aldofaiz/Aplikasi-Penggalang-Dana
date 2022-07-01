@extends('web.app', ['title' => 'Donasi'])

@section('content')
<div class="container py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-9 col-lg-7 col-xl-5">
        <div class="card">
          <img src="{{ asset('storage/'.$program->program_poster) }}"
            class="card-img-top" alt="Black Chair" />
          <div class="card-body">
            <div class="card-title d-flex justify-content-between mb-0">
              <p class="mb-0">{{ $program->program_title }}</p>
              <p class="text-muted mb-0">{{ $category->category_name }}</p>
            </div>
          </div>
          
          <div class="rounded-bottom" style="background-color: #eee;">
            <div class="card-body">
              <form action="#" id="donation_form">
              <p class="mb-1">Donasi</p>
              <hr>
              <input type="hidden" name="donor_id" value="{{ $donor->id }}" class="form-control" id="donor_id">
              <input type="hidden" name="program_id" value="{{ $program->id }}" class="form-control" id="program_id">
              <div class="form-outline mb-3">
                <label class="form-label" for="">Jumlah</label>
                <input type="number" name="amount" id="amount" class="form-control" />                
              </div>

              <div class="row mb-3">
                <div class="col-12">
                  <div class="form-outline">
                    <label class="form-label" for="">Komentar (Opsional)</label>
                    <textarea name="note" cols="30" rows="3" class="form-control" id="note"></textarea>             
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Kirim</button>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
@endsection

@push('css')

@endpush
@push('js')
<script src="https://code.jquery.com/jquery-3.4.1.min.js">
</script>
<script type="text/javascript" src="
{{!config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
data-client-key="{{ config('services.midtrans.clientKey') }}">
</script>
<script>
  $("#donation_form").submit(function(event) {
      event.preventDefault();
      //$.post("/api/donation", {
      $.post("{{ route('donation.store') }}", {
          _method: 'POST',
          _token: '{{ csrf_token() }}',
          donor_id: $('input#donor_id').val(),
          program_id: $('input#program_id').val(),
          amount: $('input#amount').val(),
          note: $('textarea#note').val(),
      },
      function (data, status) {
          console.log(data);
          snap.pay(data.snap_token, {
              // Optional
              onSuccess: function (result) {
                  location.reload();
              },
              // Optional
              onPending: function (result) {
                  location.reload();
              },
              // Optional
              onError: function (result) {
                  location.reload();
              }
          });
          return false;
      });
  })
</script>
@endpush