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
								<tr style="border: 1px solid black;">
									<th style="border: 1px solid black;"><span>Email người đặt hàng</span></th>
									<th style="border: 1px solid black;"><span>Họ tên người đặt hàng</span></th>
									<th style="border: 1px solid black;"><span>SĐT người đặt hàng</span></th>
								</tr>
							</thead>
							<tbody align="center">
								<tr style="border: 1px solid black;">
									<td style="border: 1px solid black;">{{$order_id[0]->email}}</td>
									<td style="border: 1px solid black;">{{$order_id[0]->buyer}}</td>
									<td style="border: 1px solid black;">{{$order_id[0]->buyer_phone}}</td>
								</tr>
							</tbody>
							<thead align="center">
							<tr style="border: 1px solid black;">
								<th style="border: 1px solid black;"><span>Địa chỉ người nhận</span></th>
								<th style="border: 1px solid black;"><span>Họ tên người nhận</span></th>
								<th style="border: 1px solid black;"><span>SĐT người nhận</span></th>
							</tr>
							</thead>
							<tbody align="center">
								<tr style="border: 1px solid black;">
									<td style="border: 1px solid black;">{{$order_id[0]->receiver_address}}</td>
									<td style="border: 1px solid black;">{{$order_id[0]->receiver}}</td>
									<td style="border: 1px solid black;">{{$order_id[0]->receiver_phone}}</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-hover m-b-0">
							<thead align="center">
								<tr>
									<th><span>#</span></th>
									<th><span>Tên sản phẩm</span></th>
									<th><span>Số lượng</span></th>
									<th><span>Giá</span></th>
									<th><span>Tổng tiền sản phẩm</span></th>
								</tr>
							</thead>
							<tbody id="here" align="center">
								<div hidden>{{$i = 1}}</div>
								@foreach($order_id as $data)
								<tr>
									<td>
										{{$i++}}
									</td>
									<td>
										{{$data->products_name}}
									</td>
									<td>
										{{$data->product_qty}}
									</td>
									<td>
										{{$data->product_price}}
									</td>
									<td>
										{{$s=number_format($data->product_qty*$data->product_price)}}
									</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot align="center" style="border-color: red;">
								<tr>
									<td style="font-weight: bolder;">Tổng hóa đơn</td>
									<td></td>
									<td></td>
									<td style="font-weight: bolder;">{{$data->sum}}</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
