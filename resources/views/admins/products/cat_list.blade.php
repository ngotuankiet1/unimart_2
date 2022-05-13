@extends('layouts/admins')
@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-header font-weight-bold">
                        Danh mục sản phẩm
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store.product.cat') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select class="form-control" id="" name="parent_cat">
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
                            {{-- <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                        value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                        value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Công khai
                                    </label>
                                </div>
                            </div> --}}



                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách
                    </div>
                    <div class="card-body">
                        @if ($list_cat > 0)
                            @php
                                $order = 0;
                            @endphp
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_cat as $cat)
                                        @php
                                            $order += 1;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $order }}</th>
                                            <td>
                                                @php
                                                    $str = '';
                                                    for ($i = 0; $i < $cat->lever; $i++) {
                                                        echo $str;
                                                        $str .= '--';
                                                    }
                                                @endphp
                                                {{ $cat->name }}
                                            </td>
                                            <td>
                                                <a href="{{url('admin/product/cat/edit',$cat->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ route('delete.product.cat', $cat->id) }}"
                                                    onclick="return confirm('Bạn có chắc muốn xóa?')"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-danger">Không có dữ liệu</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
