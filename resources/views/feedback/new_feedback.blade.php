@extends('layouts.master_admin') 

@section('controll')
New Feedback
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
			<div class="box-header">
				<h3 class="box-title">Phản hồi tích cực</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				
				<div class="form-group">
					@csrf
					<input name="name" type="text" class="form-control" id="getName" placeholder="Tên khách hàng"><br>

					<input name="occupation" type="text" class="form-control" id="getOccupation" placeholder="Nghề nghiệp"><br>

					<input name="image" type="file" class="form-control" id="image" placeholder="Hình ảnh"><br>
					
					<textarea name="content" type="text" class="form-control" id="getContent" placeholder="Lời nhận xét tích cực" rows="2" cols="10"></textarea><br>

					<select name="status" class="form-control" id="getStatus">
						<option value="1">Công khai</option>
						<option value="0">Riêng tư</option>
					</select><br>

						{{-- <script>
							CKEDITOR.replace('content');
						</script> --}}

						<button type="button" class="btn btn-success btn-save" >Lưu thông tin</button>
						
						<a href="/admin/feedback" class="btn btn-danger">Hủy bỏ</a>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$('.btn-save').click(function(){
				var form_data = new FormData();
				form_data.append("_token", '{{csrf_token()}}');
				form_data.append("name", $('#getName').val());
				form_data.append("occupation", $('#getOccupation').val());
				form_data.append('image', $('input[type=file]')[0].files[0]); 
				form_data.append("content", $('#getContent').val());
                form_data.append("status", $('#getStatus').val());
				$.ajax({
					type : 'post',
					url : '/admin/feedback',
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

							window.scroll({
								top: 100,
								behavior: 'smooth'
							});
						}
						if(response.is === 'success'){
							$(".success-msg").find("ul").html('');
							$(".success-msg").css('display','block');
							$(".error-msg").css('display','none');
							$(".unsuccess-msg").css('display','none');

							$(".success-msg").find("ul").append('<li>'+response.complete+'</li>');

							window.scroll({
								top: 100,
								behavior: 'smooth'
							});
						}
						if(response.is === 'unsuccess'){
							$(".unsuccess-msg").find("ul").html('');
							$(".unsuccess-msg").css('display','block');
							$(".error-msg").css('display','none');
							$(".success-msg").css('display','none');

							$(".unsuccess-msg").find("ul").append('<li>'+response.uncomplete+'</li>');

							window.scroll({
								top: 100,
								behavior: 'smooth'
							});
						}
					}
				});
			});
		</script>
@endsection