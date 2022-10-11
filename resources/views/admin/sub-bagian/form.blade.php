<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="basicInput">Nama Sub Bagian</label>
            <input type="text" class="form-control @error('nama_sub_bagian') is-invalid @enderror"
                value="{{ old('nama_sub_bagian', $subBagian->nama_sub_bagian ?? '') }}" name="nama_sub_bagian"
                placeholder="Masukan Nama Sub Bagian">
            @error('nama_sub_bagian')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="col-sm-12 d-flex justify-content-start mt-4">
            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
            <a href="{{ route('admin.sub-bagian.index') }}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
        </div>
    </div>
</div>
