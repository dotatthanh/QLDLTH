{{-- @csrf
<div class="row">
    @foreach ($permissions as $permission)
	    <div class="col-sm-4">
	        <div class="custom-control custom-checkbox custom-checkbox-info mb-3">
	            <input name="permissions[{{ $permission->id }}]" type="checkbox" class="custom-control-input" id="customCheckcolor{{ $permission->id }}" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
	            <label class="custom-control-label" for="customCheckcolor{{ $permission->id }}">{{ $permission->name }}</label>
	        </div>
	    </div>
    @endforeach
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('permissions.index') }}" class="btn btn-secondary waves-effect">Quay lại</a> --}}

@csrf
<div class="row">
	<div class="col-sm-4 mb-3">
		@foreach ($permissions as $permission)
			@if ($loop->iteration == 1)
				<h5>Quản lý tài khoản</h5>
			@endif

			<div class="custom-control custom-checkbox custom-checkbox-info mb-3">
				<input name="permissions[{{ $permission->id }}]" type="checkbox" class="custom-control-input" id="customCheckcolor{{ $permission->id }}" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
				<label class="custom-control-label" for="customCheckcolor{{ $permission->id }}">{{ $permission->name }}</label>
			</div>

			@if ($loop->iteration == 4)
				</div>
				<div class="col-sm-4 mb-3">
					<h5>Quản lý vai trò</h5>
			@endif

			@if ($loop->iteration == 8)
				</div>
				<div class="col-sm-4 mb-3">
					<h5>Quản lý quyền</h5>
			@endif

			@if ($loop->iteration == 11)
				</div>
				<div class="col-sm-4 mb-3">
					<h5>Quản lý trạm</h5>
			@endif

			@if ($loop->iteration == 14)
				</div>
				<div class="col-sm-4 mb-3">
					<h5>Quản lý quá phần mềm hỗ trợ</h5>
			@endif
			
			@if ($loop->iteration == 18)
				</div>
				<div class="col-sm-4 mb-3">
					<h5>Quản lý quá tài liệu</h5>
			@endif

			@if ($loop->iteration == 22)
				</div>
				<div class="col-sm-4 mb-3">
					<h5>Quản lý phân vùng</h5>
			@endif

			@if ($loop->iteration == 26)
				</div>
				<div class="col-sm-4 mb-3">
					<h5>Quản lý lịch hội nghị</h5>
			@endif

			@if ($loop->iteration == 30)
				</div>
				<div class="col-sm-4 mb-3">
					<h5>Quản lý giới thiệu hệ thống truyền hình</h5>
			@endif
		@endforeach

	</div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('permissions.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>