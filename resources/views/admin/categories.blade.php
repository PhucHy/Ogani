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
			<form action="{{ route('pNewCategories')}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<table>
					<tr>
						<td>Tìm kiếm</td>
						<td><input type="search" name="timkiem" id="timkiem"></td>
					</tr>
					<tr>
						<td>Mã danh mục</td>
						<td><input type="text" name="categories_id" value="{{old('categories_id')}}" style="width: 200px;"></td>
						@if($errors->first('categories_id'))
						<td>
        						<font color="red" />{{ $errors->first('categories_id') }}
						</td>
						@endif
					</tr>
					<tr>
						<td>Tên danh mục</td>
						<td><input type="text" name="categories_name" value="{{old('categories_name')}}" style="width: 200px;"></td>
						@if($errors->first('categories_name'))
						<td>
        						<font color="red" />{{ $errors->first('categories_name') }}
						</td>
						@endif
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
								<th><span>Mã danh mục</span></th>
								<th><span>Tên danh mục</span></th>
							</tr>
						</thead>
						<tbody id="here" align="center">
							@if($categories)
							@foreach($categories as $data)
							<tr>
								<td>
									<a href="categories/{{$data->categories_id}}">Xóa</a>
								</td>
								<td>
									<a href="editCategories/{{$data->categories_id}}">Sửa</a>
								</td>
								<td>
									{{$data->categories_id}}
								</td>
								<td>
									{{$data->categories_name}}
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
