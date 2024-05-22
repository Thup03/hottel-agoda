@extends('layouts.master_admin') 

@section('controll')
Feedbacks List
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách phản hồi</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div style="margin-bottom: 30px;">
						<a href="/admin/new/feedback" data-toggle="modal" class="btn btn-success btn-add">Thêm phản hồi</a>
					</div>
					<table id="list-categories" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-2">Tên khách hàng</th>
								<th class="col-sm-1">Avatar</th>
								<th class="col-sm-2">Nghề nghiệp</th>
								<th class="col-sm-5">Lời nhận xét</th>
								<th class="col-sm-2">Hành động</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($feedbacks))
							@foreach ($feedbacks as $value)
							<tr>
								<td class="col-sm-2">{{$value->name}}</td>
								<td class="col-sm-1">
									<img style="width: 100%; height: 100px;" src="{{url('images/feedbacks/'.$value->image)}}" alt="">
								</td>
                                <td class="col-sm-2">{{$value->occupation}}</td>
								<td class="col-sm-5">{{$value->content}}</td>
								<td class="col-sm-2">

									<button data-id="{{$value->id}}" type="button" class="btn btn-warning btn-edit" >
										<i class="glyphicon glyphicon-edit"></i>
									</button>

                                    @if($value->status == 0)
									<button data-id="{{$value->id}}" type="button" title="Kích hoạt" class="btn btn-info btn-status" >
										<i class="fa fa-unlock"></i>
									</button>
									@else
									<button data-id="{{$value->id}}" type="button" title="Tạm ngưng" class="btn btn-success btn-status" >
										<i class="fa fa-stop-circle"></i>
									</button>
									@endif

									<button data-id="{{$value->id}}" type="button" class="btn btn-danger btn-delete">
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
		<div class="modal fade" id="editFeedback" tabindex="-1" role="dialog" aria-labelledby="formFeedback" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="border-radius : 10px;">
					<div class="modal-header">
						<h4 class="modal-title">Cập nhật thông tin</h4>
					</div>
					
					<div class="modal-body">
						@csrf
						<input name="id" type="hidden" class="form-control" id="editID" placeholder="ID"><br>

						<input name="name" type="text" class="form-control" id="editName" placeholder="Name"><br>

						<input name="occupation" type="text" class="form-control" id="editOccupation" placeholder="Nghề nghiệp"><br>

						<div style="text-align: center;">
							<img src="" name="img_thumbnail" id="Thumbnail" alt="" style="width: 100px; height:100px; ">
							<br>
						</div>

						<input name="thumbnail" type="file" class="form-control" id="editThumbnail" placeholder="Image" style="margin-top: 15px;"><br>

						<textarea name="content" type="text" class="form-control" id="editContent" placeholder="Description" rows="5" cols="10"></textarea><br>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-success btn-update" data-dismiss="modal">Cập nhật</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#list-categories').DataTable( {
				"lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]]
			} );
		} );
	</script>

	<script type="text/javascript">
		// edit
		$('.btn-edit').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/feedback/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#editID').val(response.id),
					$('#editName').val(response.name),
					$('#editOccupation').val(response.occupation),
					$('#Thumbnail').attr('src', '/images/feedbacks/'+response.image),
					$('#editContent').val(response.content)
				}
			});

			$('#editFeedback').modal('show');
		});
		
		$('.btn-update').click(function(){
			var category_id = $('#editID').val();
			var form_data = new FormData();
			form_data.append("_token", '{{csrf_token()}}');
			form_data.append("id", $('#editID').val());
			form_data.append("name", $('#editName').val());
			form_data.append("occupation", $('#editOccupation').val());
			form_data.append('image', $('input[type=file]')[0].files[0]); 
			form_data.append("content", $('#editContent').val());

			$.ajax({
				type : 'post',
				url : '/admin/update_feedback',
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
							window.location.href="/admin/feedback";
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

        // block or unblock
		$('.btn-status').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type: 'put',
				url: '/admin/update_feedback/' + id,
				data:{
					_token :$('[name="_token"]').val(),
					id : id,
				},
				success: function(response){
					toastr.success('Update Successfully!');
				}
			});

			setTimeout(function () {
				window.location.href="/admin/feedback";
			},500);
		});

		// delete
		$('.btn-delete').click(function(){
			if(confirm('Bạn có muốn xóa không?')){
				var _this = $(this);
				var id = $(this).attr('data-id');
				$.ajax({
					type: 'delete',
					url: '/admin/feedback/' + id,
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