<!-- input nama program -->
<div class="form-group">
    <label for="nrp">{{ __('NRP') }}</label>
    <input type="text" class="form-control" id="nrp" name="nrp"
        value="{{ old('nrp', isset($model) ? $model->nrp : '') }}">
</div>

<!-- input nama program -->
<div class="form-group">
    <label for="name">{{ __('Nama Program') }}</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ old('name', isset($model) ? $model->name : '') }}">
</div>
