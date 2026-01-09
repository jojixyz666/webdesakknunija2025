@extends('admin.layouts.app')

@section('title', 'Edit Data Warga')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Edit Data Warga</h1>
    <p class="text-gray-600 mt-1">Perbarui data penduduk</p>
</div>

<form action="{{ route('admin.warga.update', $warga) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Identitas</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" value="{{ old('nik', $warga->nik) }}" maxlength="16" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nik') border-red-500 @enderror">
                @error('nik')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $warga->nama) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nama') border-red-500 @enderror">
                @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor KK <span class="text-red-500">*</span></label>
                <input type="text" name="nomor_kk" value="{{ old('nomor_kk', $warga->nomor_kk) }}" maxlength="16" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nomor_kk') border-red-500 @enderror">
                @error('nomor_kk')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('jenis_kelamin') border-red-500 @enderror">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $warga->tempat_lahir) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('tempat_lahir') border-red-500 @enderror">
                @error('tempat_lahir')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $warga->tanggal_lahir->format('Y-m-d')) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('tanggal_lahir') border-red-500 @enderror">
                @error('tanggal_lahir')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Agama <span class="text-red-500">*</span></label>
                <select name="agama" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('agama') border-red-500 @enderror">
                    <option value="">Pilih Agama</option>
                    <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
                @error('agama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan <span class="text-red-500">*</span></label>
                <select name="kewarganegaraan" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('kewarganegaraan') border-red-500 @enderror">
                    <option value="WNI" {{ old('kewarganegaraan', $warga->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>WNI</option>
                    <option value="WNA" {{ old('kewarganegaraan', $warga->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>WNA</option>
                </select>
                @error('kewarganegaraan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Keluarga & Sosial</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan <span class="text-red-500">*</span></label>
                <select name="status_perkawinan" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('status_perkawinan') border-red-500 @enderror">
                    <option value="">Pilih Status</option>
                    <option value="Belum Kawin" {{ old('status_perkawinan', $warga->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ old('status_perkawinan', $warga->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ old('status_perkawinan', $warga->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ old('status_perkawinan', $warga->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
                @error('status_perkawinan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Dalam Keluarga <span class="text-red-500">*</span></label>
                <select name="status_dalam_keluarga" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('status_dalam_keluarga') border-red-500 @enderror">
                    <option value="">Pilih Status</option>
                    <option value="Kepala Keluarga" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                    <option value="Istri" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Istri' ? 'selected' : '' }}>Istri</option>
                    <option value="Anak" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Anak' ? 'selected' : '' }}>Anak</option>
                    <option value="Menantu" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Menantu' ? 'selected' : '' }}>Menantu</option>
                    <option value="Cucu" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                    <option value="Orang Tua" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                    <option value="Mertua" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Mertua' ? 'selected' : '' }}>Mertua</option>
                    <option value="Famili Lain" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                    <option value="Pembantu" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Pembantu' ? 'selected' : '' }}>Pembantu</option>
                    <option value="Lainnya" {{ old('status_dalam_keluarga', $warga->status_dalam_keluarga) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('status_dalam_keluarga')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan</label>
                <select name="pendidikan"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('pendidikan') border-red-500 @enderror">
                    <option value="">Pilih Pendidikan</option>
                    <option value="Tidak/Belum Sekolah" {{ old('pendidikan', $warga->pendidikan) == 'Tidak/Belum Sekolah' ? 'selected' : '' }}>Tidak/Belum Sekolah</option>
                    <option value="Belum Tamat SD/Sederajat" {{ old('pendidikan', $warga->pendidikan) == 'Belum Tamat SD/Sederajat' ? 'selected' : '' }}>Belum Tamat SD/Sederajat</option>
                    <option value="Tamat SD/Sederajat" {{ old('pendidikan', $warga->pendidikan) == 'Tamat SD/Sederajat' ? 'selected' : '' }}>Tamat SD/Sederajat</option>
                    <option value="SLTP/Sederajat" {{ old('pendidikan', $warga->pendidikan) == 'SLTP/Sederajat' ? 'selected' : '' }}>SLTP/Sederajat</option>
                    <option value="SLTA/Sederajat" {{ old('pendidikan', $warga->pendidikan) == 'SLTA/Sederajat' ? 'selected' : '' }}>SLTA/Sederajat</option>
                    <option value="Diploma I/II" {{ old('pendidikan', $warga->pendidikan) == 'Diploma I/II' ? 'selected' : '' }}>Diploma I/II</option>
                    <option value="Akademi/Diploma III/S.Muda" {{ old('pendidikan', $warga->pendidikan) == 'Akademi/Diploma III/S.Muda' ? 'selected' : '' }}>Akademi/Diploma III/S.Muda</option>
                    <option value="Diploma IV/Strata I" {{ old('pendidikan', $warga->pendidikan) == 'Diploma IV/Strata I' ? 'selected' : '' }}>Diploma IV/Strata I</option>
                    <option value="Strata II" {{ old('pendidikan', $warga->pendidikan) == 'Strata II' ? 'selected' : '' }}>Strata II</option>
                    <option value="Strata III" {{ old('pendidikan', $warga->pendidikan) == 'Strata III' ? 'selected' : '' }}>Strata III</option>
                </select>
                @error('pendidikan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('pekerjaan') border-red-500 @enderror">
                @error('pekerjaan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="md:col-span-2">
                <label class="flex items-center">
                    <input type="checkbox" name="wajib_pilih" value="1" {{ old('wajib_pilih', $warga->wajib_pilih) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Wajib Pilih (17 tahun ke atas)</span>
                </label>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Alamat</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dusun <span class="text-red-500">*</span></label>
                <input type="text" name="dusun" value="{{ old('dusun', $warga->dusun) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('dusun') border-red-500 @enderror">
                @error('dusun')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">RT <span class="text-red-500">*</span></label>
                <input type="text" name="rt" value="{{ old('rt', $warga->rt) }}" maxlength="3" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('rt') border-red-500 @enderror">
                @error('rt')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">RW <span class="text-red-500">*</span></label>
                <input type="text" name="rw" value="{{ old('rw', $warga->rw) }}" maxlength="3" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('rw') border-red-500 @enderror">
                @error('rw')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="md:col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                <textarea name="alamat" rows="3" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('alamat') border-red-500 @enderror">{{ old('alamat', $warga->alamat) }}</textarea>
                @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.warga.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
            Batal
        </a>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Update Data
        </button>
    </div>
</form>
@endsection
