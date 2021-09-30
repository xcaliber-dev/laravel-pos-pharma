@extends('layouts.app')

@section('content')
  @include('layouts.headers.cards')

  <div class="container-fluid mt--7">

    <div class="row mt-5">
    </div>
    @include('layouts.footers.auth')
    <img alt="QR Code" style="visibility: visible; margin=top:100px"  src="https://www.fib.iq/images/qr-codes/prod/FIB.png">
  </div>
@endsection



@push('js')
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
