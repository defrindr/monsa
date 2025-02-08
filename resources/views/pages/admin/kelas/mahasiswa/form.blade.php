<div class="form-group">
    <label for="name">{{ __('Mahasiswa') }}</label>
    <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
        @foreach ($listMahasiswa as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>