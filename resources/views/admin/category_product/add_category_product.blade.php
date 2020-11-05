@extends('admin_layout')
@section('admin_content')

<!-- khởi đầu  -->
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{URL::to('/dashboard')}}">Home</a>
        </li>
        <li class="active">Danh mục sản phẩm</li>
        <li class="active">Thêm danh mục sản phẩm</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-header">
    <h1>
        Danh mục sản phẩm
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Thêm danh mục sản phẩm
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
  <form class="form-horizontal" role="form" action="{{URL::to('/save-category-product')}}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tên thương hiệu  </label>

        <div class="col-sm-9">
            <input type="text" id="form-field-1" name="category_product_name" placeholder="Điền danh mục" class="col-xs-10 col-sm-5" />
        </div>
    </div>

    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Mô tả</label>

        <div class="col-sm-9">
            <textarea name=" brand_product_desc" style="resize: none" rows="4" type="text" id="form-field-2" placeholder="Mô tả" class="col-xs-10 col-sm-5">

            </textarea >
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Hiển thị</label>

        <div class="col-sm-3">
            <select class="form-control" id="form-field-select-1" name= "category_product_status">
            <option value="1" >Hiển thị</option>
            <option value="0" >Ẩn</option>
            </select>
        </div>
    </div>


    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit" name="add_category_product">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Thêm danh mục sản phẩm
            </button>
        </div>
    </div>
    </form>
</div>
@endsection
