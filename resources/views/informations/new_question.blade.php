@extends('layouts.master_admin') 

@section('controll')
New Question
@endsection

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

@csrf
<div class="form-group">
	<br>
	<label for="sel1">Câu hỏi</label>
	<br>
	<br>
	<textarea name="question" id="getQuestion" rows="20" cols="100">
	</textarea>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script>
		var question = CKEDITOR.replace( 'question', {
			filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
			filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
			filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
			filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
			filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
			filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
		} );
	</script>
    <br>
	<label for="sel1">Trả lời</label>
	<br>
	<br>
	<textarea name="answer" id="getAnswer" rows="20" cols="100">
	</textarea>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script>
		var answer = CKEDITOR.replace( 'answer', {
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
<button type="button" class="btn btn-success btn-save">Lưu thông tin</button>
<br>

<script type="text/javascript">
	$('.btn-save').click(function(){
		var form_data = new FormData();
		form_data.append("_token", '{{csrf_token()}}');
		form_data.append("question", question.getData());
        form_data.append("answer", answer.getData());
		$.ajax({
			type : 'post',
			url : '/admin/question',
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