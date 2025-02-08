<!-- input prodi -->
<div class="form-group">
    <label for="name">{{ __('Nama Program') }}</label>
    <select class="form-control" id="prodi_id" name="prodi_id">
        @foreach ($listProdi as $prodi)
            @if ($prodi->id == old('prodi_id', isset($model) ? $model->prodi_id : null))
                <option selected value="{{ $prodi->id }}">{{ $prodi->name }}</option>
            @else
                <option value="{{ $prodi->id }}">{{ $prodi->name }}</option>
            @endif
        @endforeach
    </select>
</div>

<!-- input nama program -->
<div class="form-group">
    <label for="name">{{ __('Nama Program') }}</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ old('name', isset($model) ? $model->name : '') }}">
</div>

<!-- input tahun -->
<div class="form-group">
    <label for="year">{{ __('Tahun') }}</label>
    <input type="text" class="form-control" id="year" name="year"
        value="{{ old('year', isset($model) ? $model->year : '') }}">
</div>
