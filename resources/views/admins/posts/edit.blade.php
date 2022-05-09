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
                Cập nhật bài viết
            </div>
            <div class="card-body">
                <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$post->name}}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Ảnh sản phẩm</label>
                        <input class="form-control-file" type="file" id="file" name="file">
                        <label for="Ảnh hiện có">Ảnh hiện có</label>
                        <img width="100px" src="{{ asset($post->images) }}" alt="">
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="desc" class="form-control" id="content" cols="30" rows="5">{{$post->desc}}</textarea>
                        @error('desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Danh mục cha</label>
                        <select class="form-control" id="" name="parent_cat">
                            <option value="0">Chọn danh mục</option>
                            @foreach ($list_cat as $item)
                                <option
                                    @if ($post->post_cat == $item->name) @php
                                     echo "selected='selected'"
                                 @endphp @endif
                                    value="{{ $item->name }}">
                                    @php
                                        $str = '';
                                        for ($i = 0; $i < $item->lever; $i++) {
                                            echo $str;
                                            $str .= '--';
                                        }
                                    @endphp
                                    {{ $item->name }}
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
                            <input @php
                                if ($post->status == 'Chờ duyệt') {
                                    echo 'checked';
                                }
                            @endphp class="form-check-input" type="radio" name="status"
                                id="exampleRadios1" value="Chờ duyệt">
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input @php
                                if ($post->status == 'Công khai') {
                                    echo 'checked';
                                }
                            @endphp class="form-check-input" type="radio" name="status"
                                id="exampleRadios2" value="Công khai">
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
