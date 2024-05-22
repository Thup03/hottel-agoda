@extends('layouts.master_admin') 

@section('controll')
New Counterpart
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
				<h3 class="box-title">Thêm đối tác</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				@csrf
				<div class="form-group">
					<label for="">Tên đối tác</label>
					<input name="name" type="text" class="form-control" id="getName" placeholder="Tên đối tác"><br>

					<label for="">Logo</label>
					<input name="logo" type="file" class="form-control" id="getImage" placeholder="Image" onchange="readURL(this);"><br>
					<div style="text-align : center; margin-top : 10px; margin-botom : 10px;">
						<img id="thumbnail" src="#" alt=""/>
					</div>
					<script>
						function readURL(input) {
							if (input.files && input.files[0]) {
								var reader = new FileReader();

								reader.onload = function (e) {
									$('#thumbnail')
										.attr('src', e.target.result)
										.width(150)
										.height(200);
								};

								reader.readAsDataURL(input.files[0]);
							}
						}
					</script>
					<br><label for="" style="margin-top : 10px;">Liên kết</label>
					<input name="link" type="text" class="form-control" id="getLink" placeholder="Liên kết (Ex : Website or Social Network...)"><br>

					<br><label for="">Thứ tự sắp xếp ( Cao xuống thấp )</label>
					<input name="order" type="number" class="form-control" id="getSortID" value="0" placeholder="Thứ tự sắp xếp ( Cao xuống thấp )"><br>

					<br><label for="">Chế độ</label>
					<select name="status" class="form-control" id="getStatus">
						<option value="1">Công khai</option>
						<option value="0">Riêng tư</option>
					</select><br>
					
					<button type="button" class="btn btn-success btn-save" >Lưu thông tin</button>

					<a href="/admin/counterpart" class="btn btn-danger">Hủy bỏ</a>
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
        form_data.append('logo', $('input[type=file]')[0].files[0]);
        form_data.append("sort_id", $('#getSortID').val());
		form_data.append("status", $('#getStatus').val());
		$.ajax({
			type : 'post',
			url : '/admin/counterpart',
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