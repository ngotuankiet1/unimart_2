@extends('layouts/admins')
@section('content')
<div class="col-8">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật sản phẩm
        </div>
        <div class="card-body">
            <form action="{{ route('update_product_cat',$cat->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$cat->name}}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Danh mục cha</label>
                    <select class="form-control" id="" name="parent_cat">
                        <option value="0">Chọn danh mục</option>
                        @foreach ($list_cat as $item)
                            <option
                             @if ($cat->id == $item->id)
                             @php
                                 echo "selected='selected'"
                             @endphp
                             @endif
                             value="{{ $item->id }}">
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



                <button type="submit" class="btn btn-primary">update</button>
            </form>
        </div>
    </div>
</div>
@endsection
