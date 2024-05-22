@extends('layouts.master_admin') 

@section('controll')
Room Detail
@endsection

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/tags-selector-tagselect/jquery.tagselect.css">
<script src="https://www.jqueryscript.net/demo/tags-selector-tagselect/jquery.tagselect.js"></script>

<script src="{{ asset("layout_user/plugins/selectize.min.js") }}"></script>
<link rel="stylesheet" href="{{ asset("layout_user/plugins/selectize.bootstrap3.min.css") }}">
<div class="alert alert-danger error-msg" style="display:none">
	<ul></ul>
</div>

<div class="alert alert-success success-msg" style="display:none">
	<ul></ul>
</div>

<div class="alert alert-warning unsuccess-msg" style="display:none">
	<ul></ul>
</div>

@if(isset($room))
@csrf

<div class="form-group">
	<label for="">Tên phòng</label>
	<input type="text" id="getTitle" class="form-control" required name="title" placeholder="Nhập tiêu đề" value="{{ $room->title }}">
</div>

<div class="form-group">
	<label for="">Ảnh</label>
	<input name="thumbnail" type="file" class="form-control" id="getThumbnail" placeholder="Image">
</div>

<div class="form-group">
	<label for="">Loại phòng</label>
	<div class="qtagselect isw360">
		<select id="getCategoryId" class="form-control select2">
			<option class="isblue" value="{{ $room->categories->id }}">{{ $room->categories->name }}</option>
		</select>
		<script>
			$('#select-state').selectize({
				maxItems: 3,
				closeAfterSelect:true,
				highlight:true,
				selectOnTab:true,
			});
		</script>
	</div>
</div>

{{-- <div class="form-group">
	<label>Tags</label>
	<div class="qtagselect isw360">
		<select name="tags[]" id="select-state" class="form-control" multiple>
			@if(isset($tags))
			@foreach($tags as $value)
			<option class="isblue" value="{{ $value->id }}">{{ $value->name }}</option>
			@endforeach
			@endif
		</select>
		<script>
			$('#select-state').selectize({
				maxItems: 20,
				closeAfterSelect:true,
				highlight:true,
				selectOnTab:true,
			});
		</script>
	</div>
</div> --}}

<div class="form-group">
	<label for="">Giá phòng / đêm</label>
	<input type="number" class="form-control" id="getPrice" placeholder="Giá phòng" value="{{$room->price}}">
</div>

<div class="form-group">
	<label for="">Số giường</label>
	<input type="number" class="form-control" id="getNoBed" placeholder="Số giường" value="{{$room->no_bed}}">
</div>

<div class="form-group">
	<label for="">Loại giường</label>
	<input type="text" class="form-control" id="getBedType"
	placeholder="Giường đơn | Giường đôi"  value="{{$room->bed_type}}">
</div>

<div class="form-group">
	<label for="">Đồ đạc trong phòng</label>
	<textarea name="facility" type="text" class="form-control" id="getFacility"
		placeholder="Điều hòa, Tivi, Tủ lạnh, ..." rows="5" cols="10">{!! $room->facility !!}</textarea><br>
</div>

<div class="form-group">
	<label for="">Chế độ</label>
	<select name="status" class="form-control" id="getAvaiable">
		<option value="1" <?php if($room->avaiable == 1) echo "selected"; ?>>Còn phòng</option>
		<option value="0" <?php if($room->avaiable == 0) echo "selected"; ?>>Hết phòng</option>
	</select><br>
</div>

<div class="form-group">
	<label for="">Mô tả chung</label>
	<textarea name="description" type="text" class="form-control" id="getDescription" placeholder="Description" rows="10" cols="10">{!! $room->description !!} </textarea><br>
</div>

<div class="form-group">
	<label for="sel1">Giới thiệu chi tiết phòng</label>
	<br>

	<textarea name="content" id="getContent" rows="20" cols="1000">
		{!! $room->content !!} 
	</textarea>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script>
		var editor = CKEDITOR.replace( 'content', {
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
<button type="button" data-id={{$room->id}} class="btn btn-danger btn-update">Cập nhật thông tin</button>

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
		var id = $(this).attr('data-id');

		var form_data = new FormData();
		form_data.append("_token", '{{ csrf_token() }}');
		form_data.append("title", $('#getTitle').val());
		form_data.append("id", id);
		form_data.append("content", editor.getData());
		form_data.append('thumbnail', $('input[type=file]')[0].files[0]);
		form_data.append("description", $('#getDescription').val());
		form_data.append("price", $('#getPrice').val());
		form_data.append("no_bed", $('#getNoBed').val());
		form_data.append("bed_type", $('#getBedType').val());
		form_data.append("facility", $('#getFacility').val());
		form_data.append("avaiable", $('#getAvaiable').val());
		form_data.append("category_id", $('#getCategoryId').val());
		form_data.append("tags", $('select[name="tags[]"]').val());

		$.ajax({
			type : 'post',
			url : '/admin/room/update',
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