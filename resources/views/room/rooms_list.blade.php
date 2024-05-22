@extends('layouts.master_admin')

@section('controll')
    Room List
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div style="margin-bottom: 30px;">
                            @if ($title != 'Dịch vụ')
                                <a href="/admin/new/room" data-toggle="modal" class="btn btn-info btn-add">
                                    Thêm phòng mới
                                </a>
                            @endif
                        </div>
                        <table id="list-rooms" class="table table-bordered table-striped" style="margin-top : 10px;">
                            <thead>
                                <tr>
                                    <th class="col-sm-2 text-center">Tên phòng</th>
                                    <th class="col-sm-1 text-center">Loại phòng</th>
                                    <th class="col-sm-2 text-center">Ảnh</th>
                                    <th class="col-sm-1 text-center">Số giường</th>
                                    <th class="col-sm-2 text-center">Đồ đạc</th>
                                    <th class="col-sm-1 text-center">Giá</th>
                                    <th class="col-sm-1 text-center">Tình trạng</th>
                                    <th class="col-sm-2 text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($rooms))
                                    @foreach ($rooms as $value)
                                        <tr>
                                            <td class="col-sm-2 text-center">{{ $value->title }}</td>
                                            <td class="col-sm-1 text-center">{{ $value->categories->name }}</td>
                                            <td class="col-sm-2 text-center">
                                                <div style="text-align: center;">
                                                    <img style="width: 100%; height: 100px;"
                                                        src="{{ url('images/' . $value->thumbnail) }}" alt="">
                                                </div>
                                            </td>
                                            <td class="col-sm-1 text-center">{{ $value->no_bed }}</td>

                                            <td class="col-sm-2 text-center">{{ $value->facility }}</td>
                                            <td class="col-sm-1 text-center">
                                                {{number_format($value->price ,0 ,'.' ,'.')}} VND<small>/đêm</small>
                                            </td>
                                            <td class="col-sm-1 text-center">
												@if($value->avaiable == 1)
													<span class="label label-success">Còn phòng</span>
												@else
													<span class="label label-danger">Hết phòng</span>
												@endif
											</td>
                                            <td class="col-sm-2 text-center">
                                                <button data-id="{{ $value->id }}" type="button"
                                                    class="btn btn-primary btn-show">
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </button>

                                                <a href="/admin/room/detail/{{ $value->id }}" type="button"
                                                    class="btn btn-warning btn-edit">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </a>

                                                <button data-id="{{ $value->id }}" type="button"
                                                    class="btn btn-danger btn-delete">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- modal view -->
        <div class="col-xs-12">
            <div class="modal fade" id="showRoom" tabindex="-1" role="dialog" aria-labelledby="formRoom"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="border-radius: 20px;">
                        @csrf
                        <div class="box box-widget">
                            <div class="box-header with-border">
                                <div class="user-block">
                                    @if (Auth::guard('admin')->check())
                                        <img class="img-circle"
                                            src="{{ url('/images/admins/' . Auth::guard('admin')->user()->avatar) }}"
                                            alt="User Post" style="margin-right: 10px;">
                                    @endif
                                    <h4 class="attachment-heading" id="showTitle"></h4>
                                    <p class="description" id=showCreatedAt></p>
                                </div>
                                <!-- /.user-block -->
                                <div class="box-tools">
                                    {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                               </button> --}}

                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                            class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- Attachment -->
                                {{-- <img class="attachment-img" src="{{asset('')}}admin/dist/img/photo1.png" alt="Attachment Image">
                            --}}
                                <div class="attachment-pushed">
                                    <div class="attachment-text"
                                        style="height: 400px; overflow: scroll; box-sizing: border-box;">
                                        <p id="showDescription">

                                        </p>

                                        <p id="showContent">

                                        </p>
                                    </div>
                                    <!-- /.attachment-text -->
                                </div>
                                <!-- /.attachment-pushed -->

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#list-rooms').DataTable({
                    "lengthMenu": [
                        [25, 50, 100, 500, -1],
                        [25, 50, 100, 500, "All"]
                    ]
                });
            });
        </script>

        <script type="text/javascript">
            // show
            $('.btn-show').click(function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: "get",
                    url: "/admin/room/" + id,
                    data: {
                        _token: $('[name="_token"]').val(),
                    },
                    success: function(response) {
                        $('#showTitle').html(response.title),
                        $('#showDescription').html(response.description);
                        $('#showContent').html(response.content);
                        $('#showCreatedAt').text(response.created_at);
                    }
                });

                $('#showRoom').modal('show');
            });

            // delete
            $('.btn-delete').click(function() {
                if (confirm('Bạn có muốn xóa không?')) {
                    var _this = $(this);
                    var id = $(this).attr('data-id');
                    $.ajax({
                        type: 'delete',
                        url: '/admin/room/' + id,
                        data: {
                            _token: $('[name="_token"]').val(),
                        },
                        success: function(response) {
                            _this.parent().parent().remove();
                            window.location.reload();
                        }
                    })
                }
            });
        </script>

    </section>
    <!-- /.content -->
@endsection
