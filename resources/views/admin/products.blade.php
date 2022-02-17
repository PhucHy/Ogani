@extends("layouts.masterAdmin")
@section("content")
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<div class="col-xl-12 col-md-12">
	<div class="card table-card">
		<div class="card-header">
			@if(session("message"))
			<div class="alert alert-success" style="text-align: center;">
				{{ session("message") }}
			</div>
			@endif

			@if(session("alert"))
			<div class="alert alert-danger" style="text-align: center;">
				{{ session("alert") }}
			</div>
			@endif
			<form action="{{ route('pNewProduct')}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<table>
					<tr>
						<td>Tìm kiếm</td>
						<td><input type="search" name="timkiem" id="timkiem"></td>
					</tr>
					<tr>
						<td>Tên sản phẩm</td>
						<td><input type="text" name="products_name" value="{{old('products_name')}}" style="width: 200px;"></td>
						@if($errors->first('products_name'))
						<td>
        						<font color="red" />{{ $errors->first('products_name') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Giá sản phẩm</td>
						<td><input type="text" name="products_price" value="{{old('products_price')}}" style="width: 200px;"></td>
						@if($errors->first('products_price'))
						<td>
        						<font color="red" />{{ $errors->first('products_price') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Số lượng tồn kho</td>
						<td><input type="text" name="products_qty" value="{{old('products_qty')}}" style="width: 200px;"></td>
						@if($errors->first('products_qty'))
						<td>
        						<font color="red" />{{ $errors->first('products_qty') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Mô tả</td>
						<td><textarea name="products_description" value="{{old('products_description')}}" style="width: 200px;"></textarea></td>
						@if($errors->first('products_description'))
						<td>
        						<font color="red" />{{ $errors->first('products_description') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Hình ảnh</td>
						<td colspan="3"><input type="file" name="products_img" value="{{old('products_img')}}" style="width: 100%;"></td>
						@if($errors->first('products_img'))
						<td>
        						<font color="red" />{{ $errors->first('products_img') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Mã loại</td>
						<td>
							<select name="categories_id">
								@foreach($categories as $data)
								<option value="{{$data->categories_id}}">
									{{$data->categories_id}} - {{$data->categories_name}}
								</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="4" align="center"><input type="submit" id="them" name="them" value="Thêm" style="width: 80px;"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

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
								<th><span>Sửa</span></th>
								<th><span>Cập nhật</span></th>
								<th><span>Tên sản phẩm</span></th>
								<th><span>Giá</span></th>
								<th><span>Tồn kho</span></th>
								<th><span>Loại sản phẩm</span></th>
								<th><span>Hạn sử dụng</span></th>
								<th><span>Tình trạng</span></th>
							</tr>
						</thead>
						<tbody id="here" align="center">
							@if($product)
							@foreach($product as $data)
							<tr>
								<td>
									<a href="products/{{$data->products_id}}">Xóa</a>
								</td>
								<td>
									<a href="editProduct/{{$data->products_id}}">Sửa</a>
								</td>
								<td>
									<form action="" method="post">
										@csrf
									<select name="status_id" onchange="submit()">
										@foreach($status as $stat)
										<option name="status_id" value="{{$stat->status_id}}" selected hidden disabled>
											{{$data->status_id}} - {{$data->status_name}}
										</option>
										<option name="status_id" value="{{$stat->status_id}}">
											{{$stat->status_id}} - {{$stat->status_name}}
										</option>
										@endforeach
									</select>
										<input type="hidden" name="hiddenInput" id="hiddenInput" value="{{$data->products_id}}" />
									</form>
								</td>
								<td>
									{{$data->products_name}}
								</td>
								<td>
									{{number_format($data->products_price,0)}}
								</td>
								<td>
									{{$data->products_qty}}
								</td>
								<td>
									{{$data->categories_name}}
								</td>
								<td>
									{{date('d/m/Y', strtotime($data->expiry_day))}}
								</td>
								<td>
									{{$data->status_name}}
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#timkiem').on('keyup',function(){
		$value = $(this).val();
		$.ajax({
			type: 'get',
			url: '{{ URL::to('products/timkiem') }}',
			data: {
				'timkiem': $value
			},
			success:function(data){
				$('#here').html(data);
			}
		});
	})
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
