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
                Thêm bài viết
            </div>
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="name" id="name">
                        @error('name')
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

                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="desc" class="form-control" id="content" cols="30" rows="5"></textarea>
                        @error('desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <option>Chọn danh mục</option>
                        <select class="form-control" name="parent_cat" id="parent_cat">
                            <option value="0">Chọn danh mục</option>
                            @foreach ($list_cat as $cat)
                                <option value="{{ $cat->name }}">
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
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Chờ duyệt"
                                checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Công khai">
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
