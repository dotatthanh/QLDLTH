@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Tên phân vùng <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên phân vùng" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Trung tâm</label>
            <select class="form-control select2" name="type">
                <option value="">Chọn trung tâm</option>
                @foreach ($regions as $region)
                    <option value="{{ $region['key'] }}" {{ isset($data_edit->type) && $data_edit->type == $region['key'] ? 'selected' : '' }}>{{ $region['value'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('units.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>