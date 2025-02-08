<div class="form-group">
    <label for="name">{{ __('Nama Matakuliah') }}</label>
    <select name="matakuliah_id" id="matakuliah_id" class="form-control">
        @foreach ($matkuls as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="name">{{ __('Dosen Pengampu') }}</label>
    <select name="dosen_id" id="dosen_id" class="form-control">
        @foreach ($dosens as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
