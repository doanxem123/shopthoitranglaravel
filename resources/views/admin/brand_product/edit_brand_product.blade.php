@extends('admin_layout')
@section('admin_content')

<!-- khởi đầu  -->
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{URL::to('/dashboard')}}">Home</a>
        </li>
        <li class="active">Thương hiệu sản phẩm</li>
        <li class="active">Cập nhật thương hiệu sản phẩm</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-header">
    <h1>
        Thương hiệu sản phẩm
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Cập nhật thương hiệu sản phẩm
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    @foreach ($edit_brand_product as $key => $edit_value)
        {{-- expr --}}
  <form class="form-horizontal" role="form"  action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tên danh mục  </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="brand_product_name" value="{{$edit_value->brand_name}}" placeholder="Điền danh mục" class="col-xs-10 col-sm-5" />
        </div>
    </div>

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Mô tả</label>

        <div class="col-sm-9">
            <textarea name=" brand_product_desc" style="resize: none" rows="4" type="text" id="form-field-2" placeholder="Mô tả" class="col-xs-10 col-sm-5">
                {{$edit_value->brand_desc}}
            </textarea >
        </div>
    </div>
    <div class="space-4"></div>

    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit" name="update_brand_product">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Cập nhật thương hiệu sản phẩm
            </button>
        </div>
    </div>
    </form>
    @endforeach
</div>
@endsection
