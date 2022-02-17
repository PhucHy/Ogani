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
			@if(session("alert"))
			<div class="alert alert-danger" style="text-align: center;">
				{{ session("alert") }}
			</div>
			@endif
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<table>
					<tr>
						<td>Tên sản phẩm</td>
						<td><input type="text" name="products_name" value="{{$product[0]->products_name}}" style="width: 200px;"></td>
						@if($errors->first('products_name'))
						<td>
        						<font color="red" />{{ $errors->first('products_name') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Giá sản phẩm</td>
						<td><input type="text" name="products_price" value="{{$product[0]->products_price}}" style="width: 200px;"></td>
						@if($errors->first('products_price'))
						<td>
        						<font color="red" />{{ $errors->first('products_price') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Số lượng tồn kho</td>
						<td><input type="text" name="products_qty" value="{{$product[0]->products_qty}}" style="width: 200px;"></td>
						@if($errors->first('products_qty'))
						<td>
        						<font color="red" />{{ $errors->first('products_qty') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Mô tả</td>
						<td><textarea name="products_description" style="width: 200px;">{{$product[0]->products_description}}</textarea></td>
						@if($errors->first('products_description'))
						<td>
        						<font color="red" />{{ $errors->first('products_description') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Hình ảnh</td>
						<td colspan="3"><input type="file" name="products_img" style="width: 100%;"></td>
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
								@foreach($categoriesAll as $data)
								<option name="categories_id" value="{{$data->categories_id}}" selected hidden disabled>
									{{$product[0]->categories_id}} - {{$product[0]->categories_name}}
								</option>
								<option name="categories_id" value="{{$data->categories_id}}">
									{{$data->categories_id}} - {{$data->categories_name}}
								</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="4" align="center"><input type="submit" id="sua" name="sua" value="Sửa" style="width: 80px;"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
@endsection
