@extends('layouts.master_admin') 

@section('controll')
Questions List
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách câu hỏi - trả lời</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div style="margin-bottom: 30px;">
						<a href="/admin/new/question" data-toggle="modal" class="btn btn-info btn-add">Thêm câu hỏi mới</a>
					</div>
                    @csrf
					<table id="list-questions" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-4">Câu hỏi</th>
								<th class="col-sm-6">Trả lời</th>
								<th class="col-sm-2">Hành động</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($questions))
							@foreach ($questions as $value)
							<tr>
								<td class="col-sm-4">{!! $value->question !!}</td>
                                <td class="col-sm-6">{!! substr($value->answer, 0, 500) !!}...</td>
								<td class="col-sm-2">
									<a href="/admin/question/{{$value->id}}" type="button" class="btn btn-warning btn-edit" >
										<i class="glyphicon glyphicon-edit"></i>
									</a>

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

    <script>
    	$(document).ready(function() {
    		$('#list-questions').DataTable( {
    			"lengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "All"]]
    		} );
    	} );
    </script>

    <script type="text/javascript">
		// delete
		$('.btn-delete').click(function(){
			if(confirm('Bạn có muốn xóa không?')){
				var _this = $(this);
				var id = $(this).attr('data-id');
				$.ajax({
					type: 'delete',
					url: '/admin/question/' + id,
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