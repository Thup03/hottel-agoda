@extends('layouts.master_admin') 

@section('controll')
New Product Category
@endsection

@section('content')
<div class="container box box-body pad">
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-danger error-msg" style="display:none">
				<ul></ul>
			</div>

			<div class="alert alert-success success-msg" style="display:none">
				<ul></ul>
			</div>

			<div class="alert alert-warning unsuccess-msg" style="display:none">
				<ul></ul>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Thêm nhóm sản phẩm mới</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					@csrf
					<div class="form-group">

						<input name="name" type="text" class="form-control" id="getName" placeholder="Tên nhà sản xuất"><br>

						<input name="link" type="text" class="form-control" id="getLink" placeholder="Liên kết (Ex : Website or Social Network...)"><br>

						<button type="button" class="btn btn-success btn-save" >Lưu thông tin</button>

						<a href="/admin/manufacturer" class="btn btn-danger">Hủy bỏ</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.btn-save').click(function(){

		var form_data = new FormData();
		form_data.append("_token", '{{csrf_token()}}');
		form_data.append("name", $('#getName').val());
		form_data.append("link", $('#getLink').val());

		$.ajax({
			type : 'post',
			url : '/admin/manufacturer',
			data : form_data,
			dataType : 'json',
			contentType: false,
			processData: false,
			success : function(response){
				if(response.is === 'failed'){
					$(".error-msg").find("ul").html('');
					$(".error-msg").css('display','block');
					$(".success-msg").css('display','none');
					$(".unsuccess-msg").css('display','none');

					$.each(response.error, function( key, value ) {
						$(".error-msg").find("ul").append('<li>'+value+'</li>');
					});
				}
				if(response.is === 'success'){
					$(".success-msg").find("ul").html('');
					$(".success-msg").css('display','block');
					$(".error-msg").css('display','none');
					$(".unsuccess-msg").css('display','none');

					$(".success-msg").find("ul").append('<li>'+response.complete+'</li>');
				}
				if(response.is === 'unsuccess'){
					$(".unsuccess-msg").find("ul").html('');
					$(".unsuccess-msg").css('display','block');
					$(".error-msg").css('display','none');
					$(".success-msg").css('display','none');

					$(".unsuccess-msg").find("ul").append('<li>'+response.uncomplete+'</li>');
				}
			}
		});
	});
</script>
@endsection