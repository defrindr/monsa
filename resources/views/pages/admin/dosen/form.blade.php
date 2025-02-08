<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="nip">{{ __('NIP') }}</label>
            <input type="text" class="form-control" id="nip" name="nip"
                value="{{ old('nip', isset($model) ? $model->nip : '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Nama Dosen') }}</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', isset($model) ? $model->name : '') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="text" class="form-control" id="email" name="email"
                value="{{ old('email', isset($model) ? $model->user?->email : '') }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">{{ __('Password') }}</label>
            <input type="password" class="form-control" id="name" name="password"
                value="{{ old('password', isset($model) ? $model->password : '') }}">
        </div>
    </div>
</div>
