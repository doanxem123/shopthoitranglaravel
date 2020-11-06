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
        <li class="active">Liệt kê thương hiệu sản phẩm</li>
    </ul><!-- /.breadcrumb -->
</div>

<div class="page-header">
    <h1>
        Thương hiệu sản phẩm
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Liệt kê thương hiệu sản phẩm
        </small>
    </h1>
</div><!-- /.page-header -->

<div>
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
         <tr>
                <th class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </th>
                <th>Tên danh mục </th>
                <th>Nội dung </th>
                <th>Hiển thị</th>
                <th></th>
            </tr>
        </thead>


        <tbody>
             @foreach($all_brand_product as $key => $brand_pro)
            <tr>
                <td class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </td>
                  <td>
                    {{ $brand_pro->brand_name }}
                <td>
                </td>
               <td> {{ $brand_pro->brand_desc}}</td>
                 <td class="left">
                     <?php
               if($brand_pro->brand_status==0){
                ?>
                <a href="{{URL::to('/unactive-brand-product'.$brand_pro->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                 }else{
                ?>
                 <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
               }
              ?>
                </td>

                <td>
                    <div class="hidden-sm hidden-xs action-buttons">
                        <a class="blue" href="#">
                            <i class="ace-icon fa fa-search-plus bigger-130"></i>
                        </a>

                        <a class="green" href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>

                        <a class="red" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                    </div>
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
</div>
<footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
@endsection

