@extends('layouts.app')

@section('content')
    {{--    Header --}}
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Product</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                                class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Product</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <button type="button" class="btn btn btn-neutral" data-toggle="modal"
                                data-target="#addNewCashier">New Product
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
                        <h3 class="mb-0">All Products {{ $products->total() }}</h3>
                    </div>
                    <!-- Light table -->
                    @if(count($products))
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="font-size: 1rem">Name</th>
                                    <th scope="col" style="font-size: 1rem">Supplier</th>
                                    <th scope="col" style="font-size: 1rem">Price</th>
                                    <th scope="col" style="font-size: 1rem">No. Stock</th>
                                    <th scope="col" style="font-size: 1rem">Added At</th>
                                    <th scope="col" style="font-size: 1rem">Expire At</th>
                                    <th scope="col" style="font-size: 1rem">Dept</th>
                                    <th scope="col" style="font-size: 1rem">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td style="font-size: 16px">
                                            {{ $product->name }}
                                        </td>
                                        <td style="font-size: 16px">
                                            {{ $product->supplier->name }}
                                        </td>
                                        <td style="font-size: 16px">
                                            <div> {{ $product->price}} IQD</div>
                                        </td>
                                        <td style="font-size: 16px" class="">
                                            {{ $product->stock }}
                                        </td>
                                        <td style="font-size: 16px">
                                            {{ \Carbon\Carbon::parse($product->created_at)->format('Y-m-d') }}
                                        </td>
                                        <td style="font-size: 16px">
                                            <span class=" {{ $product->expire_at>=now()?"":"text-danger" }}"> {{ $product->expire_at}}</span>
                                        </td>
                                        <td style="font-size: 16px">
                                            {!!$product->is_dept?'<span class="badge badge-danger">Yes</span>':'<span class="badge badge-success">No</span>' !!}
                                        </td>

                                        <td class="td-actions d-flex">
                                            <button class="btn btn-primary btn-sm btn-fab btn-icon btn-round openEditModal" data-toggle="tooltip"
                                                    data-original-title="edit" data-id="{{$product->id}}">
                                                <i class="ni ni-settings-gear-65 pt-1"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="tooltip" data-original-title="delete"
                                                    onclick="if(confirm('Are you sure?')){
                                                            document.getElementById('form-{{$product->id}}').submit()
                                                            }">
                                                <i class="ni ni-fat-remove pt-1"></i>
                                            </button>
                                            <form class="form-inline" action="{{route('products.destroy', $product->id)}}" id="form-{{$product->id}}"
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Create Modal -->
    <div class="modal fade" id="addNewCashier" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Add new product</h2>
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
                    <form action="{{ route('products.store') }}" method="POST" id="new_products_form"
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

                        <div class="form-group">
                            <label for="email">Supplier</label>
                            <select class="custom-select" name="supplier_id">
{{--                                <option >select a supplier</option>--}}
                                @foreach($suppliers as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                        </div>
                                        <input type='number' placeholder="price in IQD" min="3000" max="100000" id="price" name="price" value="{{ old('price') }}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input type='number' placeholder="stock" id="stock" name="stock" value="{{ old('stock') }}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="expire_at">Expire At</label>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input type='date' placeholder="expire date" min='2021-09-22' max='2023-01-22' id="expire_at" name="expire_at" value="{{ old('expire_at') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Dept</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="dept_yes" name="is_dept" value="1" class="custom-control-input">
                                <label class="custom-control-label" for="dept_yes">Yes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="dept_no" name="is_dept" value="0" class="custom-control-input">
                                <label class="custom-control-label" for="dept_no">No</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="padding: .2rem 1.5rem 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="document.getElementById('new_products_form').reset()"
                            class="btn btn-default">Reset changes
                        <span class="btn-inner--icon"><i class="ni ni-button-power"></i></span>
                    </button>
                    <button type="button" onclick="document.getElementById('new_products_form').submit()"
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
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-content">
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            @if (count($errors) > 0)
            $('#addNewCashier').modal('show');
            @endif

            $('.openEditModal').on('click', function () {

                const user_id = $(this).data('id');
                let url = '{{ route("products.edit", ":id") }}';
                url = url.replace(':id', user_id);
                let updateUrl = '{{ route("products.update", ":id") }}';
                updateUrl = updateUrl.replace(':id', user_id);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data)
                        $('#modal-content').html(`

                  <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">edit ${data.name}</h2>
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
                        <form action="${updateUrl}" method="POST" id="edit_products_form"
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

                        <div class="form-group">
                            <label for="email">Supplier</label>
                            <select class="custom-select" name="supplier_id">
{{--                                <option >select a supplier</option>--}}
                        @foreach($suppliers as $key=>$value)
                        <option value="{{$key}}">{{$value}}</option>
                                @endforeach

                        </select>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                    </div>
                                    <input type='number' placeholder="price in IQD" min="3000" max="100000" id="price" name="price" value="${data.price}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input type='number' placeholder="stock" id="stock" name="stock" value="${data.stock}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expire_at">Expire At</label>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input type='date' placeholder="expire date" min='2021-09-22' max='2023-01-22' id="expire_at" name="expire_at" value="${data.expire_at}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Dept</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="dept_yes" ${data.is_dept===1?'checked':''}  name="is_dept" value="1" class="custom-control-input">
                                <label class="custom-control-label" for="dept_yes">Yes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="dept_no" name="is_dept"  ${data.is_dept===0?'checked':''} value="0" class="custom-control-input">
                                <label class="custom-control-label" for="dept_no">No</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="padding: .2rem 1.5rem 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="document.getElementById('edit_products_form').reset()"
                            class="btn btn-default">Reset changes
                        <span class="btn-inner--icon"><i class="ni ni-button-power"></i></span>
                    </button>
                    <button type="button" onclick="document.getElementById('edit_products_form').submit()"
                            class="btn btn-primary">Save changes
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