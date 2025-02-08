<!-- input nama program -->
<div class="form-group">
    <label for="name">{{ __('Nama Program') }}</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ old('name', isset($model) ? $model->name : '') }}">
</div>
