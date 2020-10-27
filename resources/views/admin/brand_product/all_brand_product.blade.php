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
        <thead>
            <tr>
                <th class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </th>
                <th>Tên thương hiệu </th>

                <th class="ace-icon fa fa-clock-o bigger-110 "> Ngày thêm</th>

                <th>
                    <i class="ace-icon fa fa-clock-o bigger-110 "></i>
                    Ngày cập nhật
                </th>
                <th>Hiển thị</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </td>

                <td>
                    <a href="#">Tên thương hiệu </a>
                </td>
                <td class="hidden-480">Feb 11</td>
                <td>Feb 12</td>
                 <td class="left">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </td>

                <td>
                    <div class="hidden-sm hidden-xs action-buttons">
                        <a class="blue" href="#">
                            <i class="ace-icon fa fa-search-plus bigger-130"></i>
                        </a>

                        <a class="green" href="#">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>

                        <a class="red" href="#">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>
                    </div>

                    <div class="hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                <li>
                                    <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                        <span class="blue">
                                            <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                        <span class="green">
                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                        <span class="red">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
