@extends("layouts.masterAdmin")
@section("content")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- sessions-section start -->
<div class="col-xl-12 col-md-12" id="test">
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
				<form action="{{route('pAdminSignup')}}" method="post">
					<style>
						::placeholder {
							color: red;
						}
					</style>
					@csrf
					<table>
						<tr>
							<td>EMAIL</td>
							<td><input type="text" name="email" placeholder="{{$errors->first('email')}}" value="{{old('email')}}" style="width: 200px;"></td>
							<td>MẬT KHẨU</td>
							<td><input type="text" name="password" placeholder="{{$errors->first('password')}}" value="" style="width: 200px;"></td>
						</tr>
						<tr>
							<td>HỌ TÊN</td>
							<td><input type="text" name="name" placeholder="{{$errors->first('name')}}" value="{{old('name')}}" style="width: 200px;"></td>
							<td>SỐ ĐIỆN THOẠI </td>
							<td><input type="text" name="phone" placeholder="{{$errors->first('phone')}}" value="{{old('phone')}}" style="width: 200px;"></td>
						</tr>
						<tr>
							<td>ĐỊA CHỈ</td>
							<td colspan="3"><input type="text" name="address" placeholder="{{$errors->first('address')}}" value="{{old('address')}}" style="width: 100%;"></td>
						</tr>
						<tr>
							<td>CHỨC VỤ</td>
							<td>
								<input type="radio" id="1" name="roles_id" value="1"> Quản trị viên
								<input type="radio" id="2" name="roles_id" value="2"> Khách hàng

							</td>
						</tr>
						<tr><td><font color="red">{{$errors->first('roles_id')}} </font></td></tr>
						<tr>
							<td colspan="4" align="center"><input type="submit" name="them" id="
								them" value="Thêm" style="width: 80px;"></td>
						</tr>
					</table>
				</form>

				
			</table>
			
			<div>
				
			</div>
		</div>
		<div class="card-body px-0 py-0">
			<div class="table-responsive">
				<div class="session-scroll" style="height:478px;position:relative;">
					<table class="table table-hover m-b-0">
						<thead align="center">
							<tr>
								<th><span>Xóa</span></th>
								<th><span>Chức vụ</span></th>
								<th><span>Email</span></th>
								<th><span>Họ tên</span></th>
								<th><span>Địa chỉ</span></th>
								<th><span>Số điện thoại</span></th>
							</tr>
						</thead>
						<tbody id="here" align="center">
							@foreach($user as $data)
							<tr>
								<td>
									<a href="user/{{$data->id}}">Xóa</a>
								</td>
								<td>
									<form action="" method="post">
										@csrf
									<select name="roles_id" onchange="submit()">
										@foreach($roles as $role)
										<option value="{{$role->roles_id}}" selected hidden disabled>
											{{$data->roles_id}} - 
											@if($data->roles_id == 1)
												Quản trị viên
											@elseif($data->roles_id == 2)
												Khách hàng
											@endif
										</option>
										<option name="roles_id" value="{{$role->roles_id}}">
											{{$role->roles_id}} - 
											@if($role->roles_id == 1)
												Quản trị viên
											@elseif($role->roles_id == 2)
												Khách hàng
											@endif
										</option>
										@endforeach
									</select>
										<input type="hidden" name="hiddenInput" id="hiddenInput" value="{{$data->id}}" />
									</form>
								</td>
								<td>
									{{$data->email}}
								</td>
								<td>
									{{$data->name}}
								</td>
								<td>
									{{$data->address}}
								</td>
								<td>
									{{$data->phone}}
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
</div>

<!-- [ Main Content ] end -->
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
