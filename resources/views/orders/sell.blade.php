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
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <button type="button" id="play" class="btn btn btn-neutral"
                                data-target="#addNewCashier">Open Camara
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-lg-5 col-12 text-center">
            <select class="form-control" style="display: none" id="camera-select"></select>
            <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
            <div class="alert alert-warning alert-dismissible fade show " id="alert" style="display: none" role="alert">
                <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                <span class="alert-inner--text" id="message">${message}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>


        <div class="col-lg-5 col-12 text-center" id="showInvoice">

        </div>
        <div class="col" id="showData">

        </div>
    </div>
    </div>
@endsection

@push('js')

    <script type="text/javascript" src="{{ asset('qrcodelib.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('webcodecamjs.js') }}"></script>

    <script>
        $(document).ready(function () {
            getData()
            invoice()
            @if (count($errors) > 0)
            $('#addNewCashier').modal('show');
            @endif
        });


        function error(message) {
            $('#alert').css('display', 'block');
            $('#message').html(message)
        }

        function sound(sound) {
            let audio = document.createElement('audio')
            audio.src = `./../../public/audio/${sound}.mp3`
            audio.play();
        }

        function getData() {
            $.post('{{ route('orders.getData') }}', {
                _token: "{{ csrf_token() }}",
            }, function (resp) {
                $('#showData').html(resp)
            })
        }

        function invoice() {
            $.get('{{ route('orders.invoice') }}', {
            }, function (resp) {
                $('#showInvoice').html(resp)
            })
        }

        function undo(id) {
            $.post('{{ route('orders.undoOrder') }}', {
                    _token: "{{ csrf_token() }}",
                    id
                }, function (res) {
                    if (!res.success) {
                        getData()
                        invoice()
                        sound("fail")
                        console.log(res)
                    }
                    getData()
                invoice()
                    sound("undo")
                }
            )

        }

        (function (undefined) {
            function Q(el) {
                if (typeof el === "string") {
                    let els = document.querySelectorAll(el);
                    return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
                }
                return el;
            }

            let play = Q("#play")
            let args = {
                resultFunction: function (res) {
                    const barcode = res.code;
                    $.post('{{ route('orders.store') }}', {
                            _token: "{{ csrf_token() }}",
                            barcode
                        }, function (res) {
                            if (!res.success) {
                                sound("fail")
                                error(res.message);
                            }
                            getData()
                            invoice()
                        }
                    )
                },
            };

            let decoder = new WebCodeCamJS("#webcodecam-canvas").buildSelectMenu("#camera-select", 'environment|back').init(args).play();
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