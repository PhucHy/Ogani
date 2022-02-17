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
								<th><span>Duyệt</span></th>
								<th><span>Họ tên</span></th>
								<th><span>Tên sản phẩm</span></th>
								<th><span>Nội dung</span></th>
								<th><span>Tình trạng</span></th>
								<th><span>Ngày đăng</span></th>
							</tr>
						</thead>
						<tbody id="here" align="center">
							@if(session("message"))
							<div class="alert alert-success" style="text-align: center;">
								{{ session("message") }}
							</div>
							@endif
							@foreach($cmt as $data)
							<tr>
								<td>
									<a href="comment/Xoa/{{$data->comment_id}}">Xóa</a>
								</td>
								<td>
									<a href="comment/{{$data->comment_id}}">Duyệt</a>
								</td>
								<td>
									{{$data->name}}
								</td>
								<td>
									{{$data->products_name}}
								</td>
								<td>
									{{$data->comment}}
								</td>
								<td>
									{{$data->status_name}}
								</td>
								<td>
									{{date('d/m/Y', strtotime($data->created_at))}}
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
