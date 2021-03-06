@extends('layouts.app')

@push('css')
    <!-- Filepond stylesheet -->
    <link href="{{ asset("plugins/filepond/css/filepond.min.css")}}" rel="stylesheet"/>
    <link href="{{ asset("plugins/filepond/css/filepond-plugin-image-preview.min.css")}}" rel="stylesheet"/>
@endpush

@section('content')
    {{--    Header --}}
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Cashier</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                                class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('cashiers.index') }}">Cashier</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cashiers</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <button type="button" class="btn btn btn-neutral" data-toggle="modal"
                                data-target="#addNewCashier">New Cashier
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--    Page Content --}}
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">All Cashiers {{ $cashiers->total() }}</h3>
                    </div>
                    <!-- Light table -->
                    @if(count($cashiers))
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Profile Image</th>
                                    <th scope="col" class="sort" data-sort="name">Name</th>
                                    <th scope="col" class="sort" data-sort="budget">Email</th>
                                    <th scope="col" class="sort" data-sort="budget">Phone</th>
                                    <th scope="col" class="sort" data-sort="budget">Address</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($cashiers as $supplier)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder"
                                                         src="{{ asset($supplier->image) }}">
                                                </a>

                                            </div>
                                        </th>
                                        <td class="budget">
                                            {{ $supplier->name }}
                                        </td>
                                        <td>
                                            {{ $supplier->email }}
                                        </td>
                                        <td class="d-flex flex-column">
                                            <div><span class="font-weight-bold">{{ __('Phone') }}:  </span> {{ $supplier->phone }}</div>
                                            <div><span class="font-weight-bold">{{ __('Alt Phone') }}: </span> {{ $supplier->alt_phone }} </div>
                                        </td>
                                        <td>
                                            {{ $supplier->address }}
                                        </td>
                                        <td class="td-actions d-flex">
                                            <button class="btn btn-primary btn-sm btn-fab btn-icon btn-round openEditModal" data-toggle="tooltip"
                                                    data-original-title="edit" data-id="{{$supplier->id}}">
                                                <i class="ni ni-settings-gear-65 pt-1"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="tooltip" data-original-title="delete"
                                                    onclick="if(confirm('Are you sure?')){
                                                            document.getElementById('form-{{$supplier->id}}').submit()
                                                            }">
                                                <i class="ni ni-fat-remove pt-1"></i>
                                            </button>
                                            <form class="form-inline" action="{{route('cashiers.destroy', $supplier->id)}}" id="form-{{$supplier->id}}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>

                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    @else
                        <h1>sds</h1>
                @endif

                <!-- Card footer -->
                    <div class="card-footer py-4">
                        {{ $cashiers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Create Modal -->
    <div class="modal fade" id="addNewCashier" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 700px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Add new cashier</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: .5rem 1.5rem">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                                <span class="alert-inner--text"> {{ $error }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">??</span>
                                </button>
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('cashiers.store') }}" method="POST" id="new_cashiers_form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                </div>
                                <input type="text" placeholder="name" id="name" name="name" value="{{ old('name') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input type="email" placeholder="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input type="password" placeholder="password" id="password" name="password" value="{{ old('password') }}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                        </div>
                                        <input type='tel' placeholder="phone" id="phone" name="phone" value="{{ old('phone') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="alt_phone">Alt Phone</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                        </div>
                                        <input type='tel' placeholder="alt phone" id="alt_phone" name="alt_phone" value="{{ old('alt_phone') }}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                        </div>
                                        <input type='text' placeholder="address" id="address" name="address" value="{{ old('address') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <label for="file">Profile image</label>
                            <input type="file" class="filepond" name="file"/>
                        </div>

                    </form>
                </div>
                <div class="modal-footer" style="padding: .2rem 1.5rem 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        <button type="button" onclick="document.getElementById('new_cashiers_form').reset()"
                                class="btn btn-default">Reset changes
                            <span class="btn-inner--icon"><i class="ni ni-button-power text-warning"></i></span>
                        </button>
                        <button type="button" onclick="document.getElementById('new_cashiers_form').submit()"
                                class="btn btn-primary">Save changes
                            <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                        </button>

                </div>
            </div>
        </div>
    </div>

    <!--  Edit modal Modal -->
    <div class="modal fade editModal" id="edit" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 700px" role="document">
            <div class="modal-content" id="modal-content">
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset("plugins/filepond/js/filepond.js") }}"></script>
    <script src="{{ asset("plugins/filepond/js/filepond-plugin-file-encode.min.js")}}"></script>
    <script src="{{ asset("plugins/filepond/js/filepond-plugin-image-exif-orientation.min.js")}}"></script>
    <script src="{{ asset("plugins/filepond/js/filepond-plugin-image-crop.min.js")}}"></script>
    <script src="{{ asset("plugins/filepond/js/filepond-plugin-image-resize.min.js")}}"></script>
    <script src="{{ asset("plugins/filepond/js/filepond-plugin-image-transform.min.js")}}"></script>
    <script src="{{ asset("plugins/filepond/js/filepond-plugin-image-preview.min.js")}}"></script>


    <script>
        /*
      We need to register the required plugins to do image manipulation and previewing.
      */
        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginImagePreview,
            FilePondPluginImageCrop,
            FilePondPluginImageResize,
            FilePondPluginImageTransform
        );

        // Select the file input and use
        // create() to turn it into a pond
        FilePond.create(
            document.querySelector('.filepond'),
            {
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                imagePreviewHeight: 170,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 200,
                stylePanelLayout: 'compact circle',
                styleLoadIndicatorPosition: 'center bottom',
                styleProgressIndicatorPosition: 'right bottom',
                styleButtonRemoveItemPosition: 'left bottom',
                styleButtonProcessItemPosition: 'right bottom',
            }
        )

        // FilePond.setOptions({
        //     server: '/upload',
        // });


    </script>

    <script>
        $(document).ready(function () {
            @if (count($errors) > 0)
            $('#addNewCashier').modal('show');
            @endif

            $('.openEditModal').on('click', function () {

                const user_id = $(this).data('id');
                let url = '{{ route("cashiers.edit", ":id") }}';
                url = url.replace(':id', user_id);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#modal-content').html(
                            `
                       <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Edit ${data.name} cashier</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: .5rem 1.5rem">
                    @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                                <span class="alert-inner--text"> {{ $error }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">??</span>
                                </button>
                            </div>
                        @endforeach
                            @endif
                            <form action="/cashiers/${data.id}" method="POST" id="edit_cashier_form"
                          enctype="multipart/form-data">
                        @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>
                                    <input type="text" placeholder="name" id="name" name="name" value="${data.name}" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input type="email" placeholder="email" id="email" name="email" value="${data.email}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input type="password" placeholder="password" id="password" name="password" value="${data.password}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                        </div>
                                        <input type='tel' placeholder="phone" id="phone" name="phone" value="${data.phone}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="alt_phone">Alt Phone</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                        </div>
                                        <input type='tel' placeholder="alt phone" id="alt_phone" name="alt_phone" value="${data.alt_phone}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                        </div>
                                        <input type='text' placeholder="address" id="address" name="address" value="${data.address}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer" style="padding: .2rem 1.5rem 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                        <button type="button" onclick="document.getElementById('edit_cashier_form').submit()"
                                class="btn btn-outline-success">Save changes
                            <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                        </button>

                </div>
                        `)
                        $('.editModal').modal('show');
                    }
                })
            })
        });

    </script>
@endpush()