@extends("layouts.masterAdmin")
@section("content")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- sessions-section start -->
<div class="col-xl-12 col-md-12" id="test">
	<div class="card table-card">
		<div class="card-body px-0 py-0">
			<div class="table-responsive">
				<div class="session-scroll" style="height:478px;position:relative;">
					<table class="table table-hover m-b-0">
						<thead align="center">
							<tr>
								<th><span>Xóa</span></th>
								<th><span>Xem</span></th>
								<th><span>Duyệt</span></th>
								<th><span>Tổng tiền</span></th>
								<th><span>Tình trạng</span></th>
							</tr>
						</thead>
								@if(session("message"))
								<div class="alert alert-success" style="text-align: center;">
									{{ session("message") }}
								</div>
								@endif
						<tbody id="here" align="center">
							@foreach($order as $data)
							<tr>
								<td>
									<a href="order/Xoa/{{$data->order_id}}">Xóa</a>
								</td>
								<td>
									<a href="orderdetail/{{$data->order_id}}">Xem</a>
								</td>
								<td>
									<a href="order/{{$data->order_id}}">Duyệt</a>
								</td>
								<td>
									{{$data->sum}}
								</td>
								<td>
									{{$data->status_name}}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
