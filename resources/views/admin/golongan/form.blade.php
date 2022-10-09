<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="basicInput">Nama Golongan</label>
            <input type="text" class="form-control @error('nama_golongan') is-invalid @enderror"
                value="{{ old('nama_golongan', $golongan->nama_golongan ?? '') }}" name="nama_golongan"
                placeholder="Masukan Nama Golongan">
            @error('nama_golongan')
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
