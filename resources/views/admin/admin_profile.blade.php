@extends('layouts.master_admin') 

{{-- thay đổi nội dung phần controll --}}
@section('controll')
Profile
@endsection

{{-- thay đổi nội dung phần content --}}
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<div class="alert alert-danger error-msg" style="display:none">
	<ul></ul>
</div>

<div class="alert alert-success success-msg" style="display:none">
	<ul></ul>
</div>

<div class="alert alert-warning unsuccess-msg" style="display:none">
	<ul></ul>
</div>

@if(isset($profile))
@csrf
<div class="form-group">
	<label for="sel1">Giới Thiệu</label>
	<br>
	<textarea name="introduce" id="getIntroduce" rows="20" cols="100">
		{!! $profile->introduce !!} 
	</textarea>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script>
		var introduce = CKEDITOR.replace( 'introduce', {
			filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
			filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
			filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
			filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
			filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
			filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
		} );
	</script>
</div>
<br>

<div class="form-group">
	<label for="sel1">Chi tiết</label>
	<br>
	<textarea name="detail" id="getDetail" rows="20" cols="100">
		{!! $profile->detail !!} 
	</textarea>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script>
		var detail = CKEDITOR.replace( 'detail', {
			filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
			filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
			filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
			filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
			filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
			filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
		} );
	</script>
</div>
<br>
<button type="button" data-id={{$profile->admin_id}} class="btn btn-danger btn-update">Cập nhật thông tin</button>

<style>
.qtagselect.isw360 .qtagselect__container{
	width:100%;
}
</style>
<br>
@endif

<script type="text/javascript">
	$('.btn-update').click(function(){
		var _this = $(this);
		var admin_id = $(this).attr('data-id');

		var form_data = new FormData();
		form_data.append("_token", '{{csrf_token()}}');
		form_data.append("admin_id", admin_id);
		form_data.append("introduce", introduce.getData());
		form_data.append("detail", detail.getData());

		$.ajax({
			type : 'post',
			url : '/admin/profile/update',
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