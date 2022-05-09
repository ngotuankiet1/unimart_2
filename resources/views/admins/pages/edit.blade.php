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
                Cập nhật trang
            </div>
            <div class="card-body">
                <form action="{{route('page.update',$page->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tiêu đề trang</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$page->name}}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Nội dung trang</label>
                        <textarea name="desc" class="form-control" id="content" cols="30" rows="5">{{$page->desc}}</textarea>
                        @error('desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
