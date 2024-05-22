@extends('layouts.master_admin') 

@section('controll')
Categories List
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
						<a href="/admin/new/category" data-toggle="modal" class="btn btn-success btn-add">Thêm loại phòng</a>
					</div>
					<table id="list-categories" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-1">Thứ tự sắp xếp</th>
								<th class="col-sm-2">{{ $title }}</th>
								<th class="col-sm-2">Đường dẫn </th>
								<th class="col-sm-2">Ảnh bìa</th>
								<th class="col-sm-3">Mô tả</th>
								<th class="col-sm-2">Hành động</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($categories))
							@foreach ($categories as $value)
							<tr>
								<td class="col-sm-1">{{$value->sort_id}}</td>
								<td class="col-sm-2">{{$value->name}}</td>
								<td class="col-sm-2">{{$value->slug}}</td>
								<td class="col-sm-2">
									<img style="width: 100%; height: 200px;" src="{{url('images/categories/'.$value->thumbnail)}}" alt="">
								</td>
								<td class="col-sm-3">{{$value->description}}</td>
								<td class="col-sm-2">
									<button data-id="{{$value->id}}" type="button" class="btn btn-primary btn-show">
										<i class="glyphicon glyphicon-eye-open"></i>
									</button>

									<button data-id="{{$value->id}}" type="button" class="btn btn-warning btn-edit" >
										<i class="glyphicon glyphicon-edit"></i>
									</button>

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

	<!-- modal view -->
	<div class="col-xs-12">
		<div class="modal fade" id="showCategory" tabindex="-1" role="dialog" aria-labelledby="formCategory" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="border-radius : 10px;">
					<div class="modal-header">
						<h4 class="modal-title">Thông tin loại phòng</h4>
					</div>
					<form action="" id="">
						@csrf
						<div class="modal-body">
							<input name="name" type="text" class="form-control" id="showName" placeholder="Name" disabled><br>

							<input name="parent_id" type="text" class="form-control" id="showParentId" placeholder="Sort" disabled><br>

							<div style="text-align: center;">
								<img src="" name="thumbnail" id="showThumbnail" alt="" style="width: 100px; height:200px; ">
								<br>
							</div>

							<input name="slug" type="text" class="form-control" id="showSlug" placeholder="Slug" style="margin-top: 15px;" disabled><br>

							<textarea name="description" type="text" class="form-control" id="showDescription" placeholder="Description" rows="5" cols="10" disabled></textarea><br>

							<input name="created_at" type="text" class="form-control" id="showCreatedAt" placeholder="Created At" disabled><br>

							<input name="updated_at" type="text" class="form-control" id="showUpdatedAt" placeholder="Updated At" disabled><br>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- modal edit -->
	<div class="col-xs-12">
		<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="formCategory" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="border-radius : 10px;">
					<div class="modal-header">
						<h4 class="modal-title">Cập nhật thông tin</h4>
					</div>
					
					<div class="modal-body">
						@csrf
						<input name="id" type="hidden" class="form-control" id="editID" placeholder="ID"><br>

						<input name="name" type="text" class="form-control" id="editName" placeholder="Name"><br>

						<input name="parent_id" type="number" min="0" class="form-control" id="editParentId" placeholder="Sort"><br>

						<div style="text-align: center;">
							<img src="" name="img_thumbnail" id="Thumbnail" alt="" style="width: 100px; height:100px; ">
							<br>
						</div>

						<input name="thumbnail" type="file" class="form-control" id="editThumbnail" placeholder="Image" style="margin-top: 15px;"><br>

						<input name="slug" type="text" class="form-control" id="editSlug" placeholder="Slug" disabled><br>

						<textarea name="description" type="text" class="form-control" id="editDescription" placeholder="Description" rows="5" cols="10"></textarea><br>
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
		// show
		$('.btn-show').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/category/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#showName').val(response.name),
					$('#showParentId').val(response.sort_id),
					$('#showThumbnail').attr('src', '/images/categories/'+response.thumbnail),
					$('#showSlug').val(response.slug),
					$('#showDescription').val(response.description),
					$('#showCreatedAt').val(response.created_at),
					$('#showUpdatedAt').val(response.updated_at)
				}
			});

			$('#showCategory').modal('show');
		});

		$('.btn-edit').click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				type : "get",
				url : "/admin/category/" + id,
				data : {
					_token :$('[name="_token"]').val(),
				},
				success : function(response){
					$('#editID').val(response.id),
					$('#editName').val(response.name),
					$('#editParentId').val(response.sort_id),
					$('#Thumbnail').attr('src', '/images/categories/'+response.thumbnail),
					$('#editSlug').val(response.slug),
					$('#editDescription').val(response.description)
				}
			});

			$('#editCategory').modal('show');
		});
		
		$('.btn-update').click(function(){
			var category_id = $('#editID').val();
			var form_data = new FormData();
			form_data.append("_token", '{{csrf_token()}}');
			form_data.append("id", $('#editID').val());
			form_data.append("name", $('#editName').val());
			form_data.append("sort_id", $('#editParentId').val());
			form_data.append('thumbnail', $('input[type=file]')[0].files[0]); 
			form_data.append("description", $('#editDescription').val());

			$.ajax({
				type : 'post',
				url : '/admin/update_category',
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
							window.location.href="/admin/category/";
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
					url: '/admin/category/' + id,
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