@extends('layouts.master_admin') 

@section('controll')
Users List
@endsection

@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Khách hàng đăng kí dịch vụ</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					@csrf
					<table id="list-users" class="table table-bordered table-striped" style="margin-top : 10px;">
						<thead>
							<tr>
								<th class="col-sm-2 text-center">Tên khách hàng</th>
								<th class="col-sm-1 text-center">Số điện thoại</th>
								<th class="col-sm-2 text-center">Phòng đăng kí</th>
								<th class="col-sm-1 text-center">Thời điểm nhận phòng</th>
								<th class="col-sm-1 text-center">Thời điểm trả phòng</th>
								<th class="col-sm-1 text-center">Giá phòng</th>
								<th class="col-sm-1 text-center">Hành động</th>
							</tr>
						</thead>
						<tbody>
						    @php Carbon\Carbon::setLocale('vi'); @endphp
							@foreach ($reservations as $value)
							<tr>
								<td class="col-sm-2 text-center">{{$value->name}}</td>
								<td class="col-sm-1 text-center">{{$value->phone}}</td>
								<td class="col-sm-2 text-center">{{$value->rooms->title}}</td>
								<td class="col-sm-1 text-center">{{$value->check_in_at}}</td>
								<td class="col-sm-1 text-center">{{$value->check_out_at}}</td>
								<td class="col-sm-1 text-center">{{number_format($value->rooms->price ,0 ,'.' ,'.')}} VND<small>/đêm</small></td>
								<td class="col-sm-1 text-center">
									<!-- @if($value->status == 0)
									<button data-id="{{$value->id}}" type="button" title="Đã xử lý" class="btn btn-warning btn-edit" >
										<i class="fa fa-unlock"></i>
									</button>
									@else
									<button data-id="{{$value->id}}" type="button" title="Chưa xử lý" class="btn btn-success btn-edit" >
										<i class="fa fa-stop-circle"></i>
									</button>
									@endif -->
									<button data-id="{{$value->id}}" type="button" title="Xóa" class="btn btn-danger btn-delete">
										<i class="fa fa-user-times"></i>
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th class="col-sm-2 text-center">Tên khách hàng</th>
								<th class="col-sm-1 text-center">Số điện thoại</th>
								<th class="col-sm-2 text-center">Phòng đăng kí</th>
								<th class="col-sm-1 text-center">Thời điểm nhận phòng</th>
								<th class="col-sm-1 text-center">Thời điểm trả phòng</th>
								<th class="col-sm-1 text-center">Giá phòng</th>
								<th class="col-sm-1 text-center">Hành động</th>
							</tr>
						</tfoot>
					</table>

					{{-- {{$users->links()}} --}}
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>

	<script>
		$(document).ready(function() {
			$('#list-users').DataTable( {
				"lengthMenu": [[25, 50, 100, 500, 1000, 5000, -1], [25, 50, 100, 500, 1000, 5000, "All"]],
			} );
		} );
	</script>
	<script type="text/javascript">
		// delete
		$('.btn-delete').click(function(){
			if(confirm('Bạn thực sự muốn xóa ?')){
				var _this = $(this);
				var id = $(this).attr('data-id');
				$.ajax({
					type: 'delete',
					url: '/admin/reservation/' + id,
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