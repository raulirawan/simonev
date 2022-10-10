<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="basicInput">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $pegawai->name ?? '') }}" name="name" placeholder="Masukan Nama Pegawai">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="basicInput">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $pegawai->email ?? '') }}" name="email" placeholder="Masukan Email Pegawai">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="basicInput">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                placeholder="Masukan Password Pegawai">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="basicInput">Sub Bagian</label>
            <select name="sub_bagian_id" id="sub_bagian_id"
                class="form-control @error('sub_bagian_id') is-invalid @enderror">
                <option value="">Pilih Sub Bagian</option>
                @foreach (App\SubBagian::all() as $bagian)
                    <option value="{{ $bagian->id }}"
                        {{ isset($pegawai) ? ($bagian->id == $pegawai->sub_bagian_id ? 'selected' : '') : '' }}>
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
            <a href="{{ route('admin.pegawai.index') }}" class="btn btn-light-secondary me-1 mb-1">Kembali</a>
        </div>
    </div>
</div>
