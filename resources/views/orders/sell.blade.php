@extends('layouts.app')

@section('content')
{{--    Header --}}
<div class="header bg-primary ">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Sell</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                    class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Sell</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sells</li>
            </ol>
          </nav>
        </div><div class="col-lg-6 col-5 text-right">
              <button type="button" class="btn btn btn-neutral"
                      data-target="#addNewCashier">Open Camara
              </button>
          </div>
      </div>
    </div>
  </div>
</div>


<div class="row justify-content-center">
    <div class="col-lg-5 col-12 text-center">
            <select class="form-control" id="camera-select"></select>
            <button title="Play" class="btn btn-success btn-sm" id="play" type="button"
                    data-toggle="tooltip">Play</button>
            <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
    </div>

    <div class="col-lg-5 col-12 text-center">
        <div class="p-3 bg-white rounded">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="text-uppercase">Invoice</h1>
                    <div class="billed"><span class="font-weight-bold text-uppercase">Billed:</span><span class="ml-1">Jasper Kendrick</span></div>
                    <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1">May 13, 2020</span></div>
                    <div class="billed"><span class="font-weight-bold text-uppercase">Order ID:</span><span class="ml-1">#1345345</span></div>
                </div>
                <div class="col-md-6 text-right mt-3">
                    <h4 class="text-danger mb-0">Rae jones</h4><span>bbbootstrap.com</span>
                </div>
            </div>
            <div class="mt-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Custom oil painting (24 X 36 in.)</td>
                            <td>10</td>
                            <td>34</td>
                            <td>340</td>
                        </tr>
                        <tr>
                            <td>Digital illustraion paint(8.5 X 11 in.)</td>
                            <td>12</td>
                            <td>50</td>
                            <td>600</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>940</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-right mb-3"><button class="btn btn-danger btn-sm mr-5" type="button">Pay Now</button></div>
        </div>
    </div>
</div>




<!--  Create Modal -->
<div class="modal fade" id="addNewCashier" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Add new suppliers</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
          <span class="alert-inner--text"> {{ $error }}</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        @endforeach
        @endif
        <form action="{{ route('suppliers.store') }}" method="POST" id="new_suppliers_form"
          enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="name">Company Name</label>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
              </div>
              <input type="text" placeholder="name" id="name" name="name" value="{{ old('name') }}"
                class="form-control">
            </div>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
              </div>
              <input type="email" placeholder="email" id="email" name="email"
                value="{{ old('email') }}" class="form-control">
            </div>
          </div>


          <div class="form-group">
            <label for="phone">Phone</label>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
              </div>
              <input type='tel' placeholder="phone" id="phone" name="phone_number"
                value="{{ old('phone_number') }}" class="form-control">
            </div>
          </div>


          <div class="form-group">
            <label for="address">Address</label>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
              </div>
              <input type='text' placeholder="address" id="address" name="address"
                value="{{ old('address') }}" class="form-control">
            </div>
          </div>


        </form>
      </div>
      <div class="modal-footer" style="padding: .2rem 1.5rem 1.5rem;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="document.getElementById('new_suppliers_form').reset()"
          class="btn btn-default">Reset changes
          <span class="btn-inner--icon"><i class="ni ni-button-power"></i></span>
        </button>
        <button type="button" onclick="document.getElementById('new_suppliers_form').submit()"
          class="btn btn-primary">Save changes
          <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
        </button>

      </div>
    </div>
  </div>
</div>


@endsection

@push('js')

<script type="text/javascript" src="{{ asset('qrcodelib.js')  }}"></script>
<script type="text/javascript" src="{{ asset('webcodecamjs.js') }}"></script>

<script>
    $(document).ready(function () {
        @if (count($errors) > 0)
        $('#addNewCashier').modal('show');
        @endif
    });

    (function (undefined) {
        function Q(el) {
            if (typeof el === "string") {
                let els = document.querySelectorAll(el);
                return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
            }
            return el;
        }

        let play = Q("#play"),
            args = {
                resultFunction: function (res) {
                    const product_id = res.code;
                    console.log(product_id);
                   $.post('{{ route('orders.store') }}', {
                            _token:{{ csrf_token() }}
                       }, function (res){
                           console.log(res);
                       }
                   )
                }
            };

        let decoder = new WebCodeCamJS("#webcodecam-canvas").buildSelectMenu("#camera-select", 'environment|back').init(args);
        play.addEventListener("click", function () {
            decoder.play();
        }, false);

        document.querySelector("#camera-select").addEventListener("change", function () {
            if (decoder.isInitialized()) {
                decoder.stop().play();
            }
        });
    }).call(window.Page = window.Page || {});

</script>
@endpush()