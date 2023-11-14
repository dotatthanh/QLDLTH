@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Loại</label>
            <input readonly id="name" name="name" type="text" class="form-control" placeholder="Tên phần mềm" value="{{ getNameRegion($data_edit->type) }}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="file">Tập tin cài đặt</label>
            <input id="file" name="file" type="file" class="form-control" placeholder="Tập tin cài đặt" value="{{ old('file', $data_edit->file ?? '') }}">
            {!! $errors->first('file', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('softwares.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>