@extends('layouts.master_admin') 

@section('controll')
Contacts List
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Danh sách liên hệ</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                    @csrf
					<table id="list-contacts" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-2">Tên khách hàng</th>
								<th class="col-sm-2">Email</th>
								<th class="col-sm-5">Nội dung</th>
                                <th class="col-sm-2">Thời điểm</th>
								<th class="col-sm-1">Hành động</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($contacts))
                            @php Carbon\Carbon::setLocale('vi'); @endphp
							@foreach ($contacts as $value)
							<tr>
								<td class="col-sm-2">{{$value->name}}</td>
								<td class="col-sm-2">{{$value->email}}</td>
								<td class="col-sm-5">{{$value->content}}</td>
                                <td class="col-sm-2">
									{{Carbon\Carbon::parse($value->updated_at)->diffForHumans()}}
								</td>
								<td class="col-sm-1">
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
        $('#list-contacts').DataTable( {
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "order": [[4, "asc" ]],
        } );
    } );

    // delete
    $('.btn-delete').click(function(){
        if(confirm('Bạn có muốn xóa không?')){
            var _this = $(this);
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'delete',
                url: '/admin/contact/' + id,
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