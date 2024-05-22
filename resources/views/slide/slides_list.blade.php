@extends('layouts.master_admin') 

@section('controll')
	Slides List
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách banner</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div style="margin-bottom: 30px;">
						<a href="/admin/new/slide" data-toggle="modal" class="btn btn-success btn-add">Thêm mới banner</a>
					</div>
					<table id="list-slides" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-1">Thứ tự hiển thị</th>
								<th class="col-sm-2">Chương trình</th>
								<th class="col-sm-2">Hình ảnh</th>
								<th class="col-sm-2">Liên kết</th>
								<th class="col-sm-1">Nhà tài trợ</th>
								<th class="col-sm-1">Người tạo</th>
								<th class="col-sm-3">Hành động</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($slides))
							@foreach ($slides as $value)
							<tr>
								<td class="col-sm-1">{{$value->display_order}}</td>
								<td class="col-sm-2">{{$value->name}}</td>
								<td class="col-sm-2">
									<img style="width: 100%; height: 100px;" src="{{url('images/slides/'.$value->image)}}" alt="">
								</td>

								<td class="col-sm-2">
									{{$value->link}}
								</td>

								<td class="col-sm-1">
									{{$value->sponsor}}
								</td>

								<td class="col-sm-1">
									{{$value->createby}}
								</td>
								
								<td class="col-sm-4">
									<button data-id="{{$value->id}}" type="button" title="Xem thông tin" class="btn btn-primary btn-show">
										<i class="glyphicon glyphicon-eye-open"></i>
									</button>

									<button data-id="{{$value->id}}" type="button" title="Chỉnh sửa thông tin" class="btn btn-warning btn-edit" >
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

									<button data-id="{{$value->id}}" type="button" title="Xóa" class="btn btn-danger btn-delete">
										<i class="glyphicon glyphicon-trash"></i>
									</button>
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
						<tfoot>
							<tr>
								<th class="col-sm-1">Thứ tự hiển thị</th>
								<th class="col-sm-2">Chương trình</th>
								<th class="col-sm-2">Hình ảnh</th>
								<th class="col-sm-2">Liên kết</th>
								<th class="col-sm-1">Nhà tài trợ</th>
								<th class="col-sm-1">Người tạo</th>
								<th class="col-sm-3">Hành động</th>
							</tr>
						</tfoot>
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
		<div class="modal fade" id="showSlide" tabindex="-1" role="dialog" aria-labelledby="formSlide" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Thông tin : </h4>
					</div>
					<form action="" id="">
						@csrf
						<div class="modal-body">
							<input name="name" type="text" class="form-control" id="showName" placeholder="Name" disabled><br>

							<div style="text-align: center;">
								<img src="" name="thumbnail" id="showThumbnail" alt="" style="width: 100px; height:100px; ">
								<br>
							</div>

							<input name="createby" type="text" class="form-control" id="showCreateBy" placeholder="CreateBy" style="margin-top: 15px;" disabled><br>

							<input name="link" type="text" class="form-control" id="showLink" placeholder="Link" style="margin-top: 15px;" disabled><br>

							<input name="display_order" type="text" class="form-control" id="showDisplayOrder" placeholder="Display Order" style="margin-top: 15px;" disabled><br>

							<textarea name="description" type="text" class="form-control" id="showDescription" placeholder="Description" rows="5" cols="10" disabled></textarea><br>

							<input name="sponsor" type="text" class="form-control" id="showSponsor" placeholder="Sponsor" style="margin-top: 15px;" disabled><br>

							<input name="created_at" type="text" class="form-control" id="showCreatedAt" placeholder="Created At" disabled><br>

							<input name="updated_at" type="text" class="form-control" id="showUpdatedAt" placeholder="Updated At" disabled><br>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- modal edit -->
	<div class="col-xs-12">
		<div class="modal fade" id="editSlide" tabindex="-1" role="dialog" aria-labelledby="formSlide" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Cập nhật thông tin: </h4>
					</div>
					
					<div class="modal-body">
						@csrf
						<input name="id" type="hidden" class="form-control" id="editID" placeholder="ID"><br>

						<input name="name" type="text" class="form-control" id="editName" placeholder="Chương trình"><br>

						<div style="text-align: center;">
							<img src="" name="img_thumbnail" id="Thumbnail" alt="" style="width: 100px; height:100px; ">
							<br>
						</div>

						<input name="link" type="text" class="form-control" id="editLink" placeholder="Liên kết" style="margin-top: 15px;" ><br>

						<input name="thumbnail" type="file" class="form-control" id="editThumbnail" placeholder="Image" style="margin-top: 15px;"><br>

						<input name="display_order" type="text" class="form-control" id="editDisplayOrder" placeholder="Thứ tự hiển thị"><br>

						<textarea name="description" type="text" class="form-control" id="editDescription" placeholder="Mô tả" rows="5" cols="10"></textarea><br>

						<input name="sponsor" type="text" class="form-control" id="editSponsor" placeholder="Nhà tài trợ"><br>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-success btn-update" data-dismiss="modal">Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<script>
    	$(document).ready(function() {
    		$('#list-slides').DataTable( {
    			"lengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "All"]]
    		} );
    	} );
    </script>

	<script type="text/javascript">
		// show
		$('.btn-show').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/slide/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#showName').val(response.name),
					$('#showThumbnail').attr('src', '/images/slides/'+response.image),
					$('#showDisplayOrder').val(response.display_order),
					$('#showCreateBy').val(response.createby),
					$('#showLink').val(response.link),
					$('#showDescription').val(response.description),
					$('#showSponsor').val(response.sponsor),
					$('#showCreatedAt').val(response.created_at),
					$('#showUpdatedAt').val(response.updated_at)
				}
			});

			$('#showSlide').modal('show');
		});

		$('.btn-edit').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/slide/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#editID').val(response.id),
					$('#editName').val(response.name),
					$('#Thumbnail').attr('src', '/images/slides/'+response.image),
					$('#editLink').val(response.link),
					$('#editDisplayOrder').val(response.display_order),
					$('#editDescription').val(response.description),
					$('#editSponsor').val(response.sponsor)
				}
			});

			$('#editSlide').modal('show');
		});
		
		$('.btn-update').click(function(){
			var category_id = $('#editID').val();
			var form_data = new FormData();
			form_data.append("_token", '{{csrf_token()}}');
			form_data.append("id", $('#editID').val());
			form_data.append("name", $('#editName').val());
			form_data.append('image', $('input[type=file]')[0].files[0]); 
			form_data.append("link", $('#editLink').val());
			form_data.append("display_order", $('#editDisplayOrder').val());
			form_data.append("sponsor", $('#editSponsor').val());

			$.ajax({
				type : 'post',
				url : '/admin/update_slide',
				data : form_data,
				contentType: false,
				processData: false,
				success : function(response){
					tosatr.success("Update Successfully!");
				}
			});

			$('#editCategory').modal('hide');

			setTimeout(function () {
				window.location.href="/admin/slide";
			},1000); 
		});

		// block or unblock
		$('.btn-status').click(function(){
			var slide_id = $(this).attr('data-id');
			$.ajax({
				type: 'put',
				url: '/admin/update_status/' + slide_id,
				data:{
					_token :$('[name="_token"]').val(),
					id : slide_id,
				},
				success: function(response){
					toastr.success('Update Successfully!');
				}
			});

			setTimeout(function () {
				window.location.href="/admin/slide";
			},500);
		});

		// delete
		$('.btn-delete').click(function(){
			if(confirm('Bạn có muốn xóa không?')){
				var _this = $(this);
				var id = $(this).attr('data-id');
				$.ajax({
					type: 'delete',
					url: '/admin/slide/' + id,
					data:{
						_token : $('[name="_token"]').val(),
					},
					success: function(response){
						_this.parent().parent().remove();
					}
				})
			}
		});
	</script>

</section>
<!-- /.content -->
@endsection