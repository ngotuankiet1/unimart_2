@extends('layouts/admins')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-header font-weight-bold">
                Thêm sản phẩm
            </div>
            <div class="card-body">
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Giá</label>
                                <input class="form-control" type="text" name="price" id="price">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Ảnh sản phẩm</label>
                                <input class="form-control-file" type="file" id="file" name="file">
                                @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Mô tả sản phẩm</label>
                                <textarea name="desc" class="form-control" id="desc" cols="30" rows="5"></textarea>
                                @error('desc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="intro">Chi tiết sản phẩm</label>
                        <textarea name="intro" class="form-control" id="intro" cols="30" rows="5"></textarea>
                        @error('intro')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <option>Chọn danh mục</option>
                        <select class="form-control" name="parent_cat" id="parent_cat">
                            <option value="0">Chọn danh mục</option>
                            @foreach ($list_cat as $cat)
                                <option value="{{ $cat->id }}">
                                    @php
                                        $str = '';
                                        for ($i = 0; $i < $cat->lever; $i++) {
                                            echo $str;
                                            $str .= '--';
                                        }
                                    @endphp
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_cat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                        value="Chờ duyệt" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                        value="Công khai">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Công khai
                                    </label>
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Nổi bật</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="outstanding" id="exampleRadios1"
                                        value="1">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Có
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="outstanding" id="exampleRadios2"
                                        value="0">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Không
                                    </label>
                                </div>
                                @error('outstanding')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Kho hàng</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="warehouse" id="exampleRadios1"
                                        value="Còn hàng">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Còn hàng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="warehouse" id="exampleRadios2"
                                        value="Hết hàng">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Hết hàng
                                    </label>
                                </div>
                                @error('warehouse')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
