@extends('layouts.master_admin') 

@section('controll')
Counterparts List
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách đối tác</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div style="margin-bottom: 30px;">
						<a href="{{ url('/admin/new/counterpart') }}" data-toggle="modal" class="btn btn-info btn-add">Thêm đối tác mới</a>
					</div>
					<table id="list-counterparts" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-2">Thứ tự sắp xếp</th>
                                <th class="col-sm-3">Tên đối tác</th>
                                <th class="col-sm-2">Logo</th>
								<th class="col-sm-3">Liên kết</th>
								<th class="col-sm-2">Hành động</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($counterparts))
							@foreach ($counterparts as $value)
							<tr>
								<td class="col-sm-1">{{$value->id}}</td>
                                <td class="col-sm-3">{{$value->name}}</td>
                                <td class="col-sm-2">
									<div style="text-align: center;">
										<img style="width: 50%; height: 50px; text-align:center;" src="{{url('images/counterparts/'.$value->logo)}}" alt="">
									</div>
								</td>
								<td class="col-sm-3">{{$value->link}}</td>
								<td class="col-sm-2">
									<button data-id="{{$value->id}}" type="button" title="Chính sửa" class="btn btn-warning btn-edit" >
										<i class="glyphicon glyphicon-edit"></i>
									</button>

									<button data-id="{{$value->id}}" type="button" title="Xóa" class="btn btn-danger btn-delete">
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

	<!-- modal edit -->
	<div class="col-xs-12">
		<div class="modal fade" id="editCounterpart" tabindex="-1" role="dialog" aria-labelledby="formCounterpart" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="border-radius : 10px;">
					<div class="modal-header">
						<h4 class="modal-title">Cập nhật thông tin</h4>
					</div>
					<form action="" id="formEditCategory">
						@csrf
						<div class="modal-body">
							<input name="id" type="text" class="form-control" id="editID" placeholder="ID" disabled><br>

                            <input name="name" type="text" class="form-control" id="editName" placeholder="Tên đối tác"><br>
                            
                            <div style="text-align: center;">
                                <img src="" name="img_thumbnail" id="showLogo" alt="" style="width: 100px; height:100px; ">
                                <br>
                            </div>

                            <input name="logo" type="file" class="form-control" id="editLogo" placeholder="Logo" style="margin-top: 15px;"><br>                           
                            
                            <input name="link" type="text" class="form-control" id="editLink" placeholder="Liên kết"><br>

                            <input name="sort" type="text" class="form-control" id="editSort" placeholder="Thứ tự hiển thị"><br>

							<input name="slug" type="text" class="form-control" id="editSlug" placeholder="Slug" disabled><br>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-success btn-update" data-dismiss="modal">Cập nhật</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#list-counterparts').DataTable( {
				"lengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "All"]]
			} );
		} );
	</script>

	<script type="text/javascript">
		$('.btn-edit').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/counterpart/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#editID').val(response.id),
					$('#editName').val(response.name),
                    $('#showLogo').attr('src', '/images/counterparts/'+response.logo),
					$('#editLink').val(response.link),
                    $('#editSort').val(response.sort_id),
					$('#editSlug').val(response.slug)
				}
			});

			$('#editCounterpart').modal('show');
		});
		
        $('.btn-update').click(function(){
            var form_data = new FormData();
			form_data.append("_token", '{{csrf_token()}}');
            form_data.append("id", $('#editID').val());
			form_data.append("name", $('#editName').val());
            form_data.append("link", $('#editLink').val());
			form_data.append("sort_id", $('#editSort').val());
			form_data.append("logo", $('input[type=file]')[0].files[0]); 
			$.ajax({
				type: 'post',
				url: '/admin/update_counterpart',
				data : form_data,
                contentType: false,
				processData: false,
				success: function(response){
					if(response.is === 'failed'){
						$.each(response.error, function( key, value ) {
							message = value;
						});

						swal({
							title: "Thất bại!",
							text: message,
							icon: "error",
							buttons: true,
							buttons: ["Ok"],
							timer: 3000
						});
					}
					if(response.is === 'success'){
						swal({
							title: "Hoàn thành!",
							text: response.complete,
							icon: "success",
							buttons: true,
							buttons: ["Ok"],
							timer: 1000
						});

						setTimeout(function () {
							window.location.href="/admin/counterpart/";
						},1000);
					}
					if(response.is === 'unsuccess'){
						swal({
							title: "Thất bại!",
							text: response.uncomplete,
							icon: "error",
							buttons: true,
							buttons: ["Ok"],
							timer: 5000
						});
					}
				}
			});
		});

		// delete
		$('.btn-delete').click(function(){
			if(confirm('Bạn có muốn xóa không?')){
				var _this = $(this);
				var id = $(this).attr('data-id');
				$.ajax({
					type: 'delete',
					url: '/admin/counterpart/' + id,
					data:{
						_token : $('[name="_token"]').val(),
					},
					success: function(response){
						_this.parent().parent().remove();
						window.location.reload();
					}
				})
			}
		});
	</script>
	<script type="text/javascript" src="{{asset('home/js/sweetalert.min.js')}}"></script>
</section>
<!-- /.content -->
@endsection