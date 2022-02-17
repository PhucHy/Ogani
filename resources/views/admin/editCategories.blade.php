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
			<form action="" method="post">
				@csrf
				<table>
					<tr>
						<td>Mã danh mục</td>
						<td><input type="text" name="categories_id" value="{{$categories->categories_id}}" style="width: 200px;"></td>
						@if($errors->first('categories_id'))
						<td>
        						<font color="red" />{{ $errors->first('categories_id') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Tên danh mục</td>
						<td><input type="text" name="categories_name" value="{{$categories->categories_name}}" style="width: 200px;"></td>
						@if($errors->first('categories_name'))
						<td>
        						<font color="red" />{{ $errors->first('categories_name') }}
						</td>
						@endif
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
