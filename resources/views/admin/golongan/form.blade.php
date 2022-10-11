<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="basicInput">Nama Skpd</label>
            <input type="text" class="form-control @error('nama_golongan') is-invalid @enderror"
                value="{{ old('nama_golongan', $golongan->nama_golongan ?? '') }}" name="nama_golongan"
                placeholder="Masukan Nama Golongan">
            @error('nama_golongan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="basicInput">Sub Bagian</label>
            <select name="sub_bagian_id" id="sub_bagian_id" class="form-control">
                <option value="">Pilih Sub Bagian</option>
                @foreach (App\SubBagian::all() as $bagian)
                    <option value="{{ $bagian->id }}"
                        {{ isset($golongan) ? ($golongan->sub_bagian_id == $bagian->id ? 'selected' : '') : '' }}>
                        {{ $bagian->nama_sub_bagian }}</option>
                @endforeach
            </select>
            @error('sub_bagian_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="col-sm-12 d-flex justify-content-start mt-4">
            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
            <a href="{{ route('admin.golongan.index') }}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
        </div>
    </div>
</div>
