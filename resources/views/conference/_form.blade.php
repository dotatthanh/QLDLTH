@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="date">Ngày <span class="text-danger">*</span></label>
            <div class="docs-datepicker">
                <div class="input-group">
                    <input type="text" class="form-control docs-date" name="date" placeholder="Chọn ngày" autocomplete="off" value="{{ old('date', isset($data_edit->date) ? date('d-m-Y', strtotime($data_edit->date)) : '') }}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="docs-datepicker-container"></div>
            </div>
            {!! $errors->first('date', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="unit">Đơn vị <span class="text-danger">*</span></label>
            <input id="unit" name="unit" type="text" class="form-control" placeholder="Đơn vị" value="{{ old('unit', $data_edit->unit ?? '') }}">
            {!! $errors->first('unit', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="preside">Chủ trì <span class="text-danger">*</span></label>
            <input id="preside" name="preside" type="text" class="form-control" placeholder="Chủ trì" value="{{ old('preside', $data_edit->preside ?? '') }}">
            {!! $errors->first('preside', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="title">Tiêu đề hội nghị <span class="text-danger">*</span></label>
            <input id="title" name="title" type="text" class="form-control" placeholder="Tiêu đề hội nghị" value="{{ old('title', $data_edit->title ?? '') }}">
            {!! $errors->first('title', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group">
            <label for="bridge_point">Số điểm cầu <span class="text-danger">*</span></label>
            <input id="bridge_point" name="bridge_point" type="text" class="form-control" placeholder="Số điểm cầu" value="{{ old('bridge_point', $data_edit->bridge_point ?? '') }}">
            {!! $errors->first('bridge_point', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('roles.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>