@extends('admin.layouts.app')
@section('title', 'Tambah Pengurus')
@section('header', 'Tambah Pengurus')

@section('content')
    @php
        $menu = [
            'admin.budaya.*' => [
                'label' => 'Budaya',
            ],
            'admin.umkm.*' => ['label' => 'UMKM'],
            'admin.berita.*' => [
                'label' => 'Berita',
            ],
            'admin.acara.*' => [
                'label' => 'Acara',
            ],
            'admin.galeri.*' => [
                'label' => 'Galeri',
            ],
            'admin.pengunjung.*' => [
                'label' => 'Pengunjung',
            ],
        ];
    @endphp
    <div class="max-w-xl">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                    {{-- sub admin --}}
                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">Sub Admin? <span
                                class="text-red-500">*</span></label>
                        <select name="subAdminSelect" id="subAdminSelect"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                            <option value="true" {{ old('subAdminSelect') === 'true' ? 'selected' : '' }}>
                                Ya
                            </option>

                            <option value="false" {{ old('subAdminSelect', 'false') === 'false' ? 'selected' : '' }}>
                                Tidak
                            </option>
                        </select>

                    </div>
                </div>

                <div class="mb-6 space-y-2 border border-gray-300 rounded-lg p-3 bg-gray-50/50" id="subAdminField">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggung Jawab<span
                            class="text-red-500">*</span></label>
                    @foreach ($menu as $route => $item)
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="adminOption[]" value="{{ $route }}"
                                {{ in_array($route, old('adminOption', [])) ? 'checked' : '' }}
                                class="w-4 h-4 text-gold-600 rounded border-gray-300 focus:ring-gold-500">
                            <span class="text-sm text-gray-700">{{ $item['label'] }}</span>
                        </label>
                    @endforeach
                </div>


                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email<span
                                class="text-red-500">*</span></label>

                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                </div>
                <div class="mb-4" id="passwordField">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" name="password" value="{{ old('password') }}" id="password" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Masukkan Ulang Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        value="{{ old('password_confirmation') }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-gold-50 file:text-gold-700 file:px-3 file:py-1 file:text-sm file:font-medium">
                </div>
                <div class="flex items-center space-x-3">
                    <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium"
                        style="background: linear-gradient(135deg, #d4a017, #b8860b);">Simpan</button>
                    <a href="{{ route('admin.pengurus.index') }}"
                        class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const select = document.getElementById('subAdminSelect');
            const subAdminField = document.getElementById('subAdminField');
            const passwordField = document.getElementById('passwordField');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const passwordInput = document.getElementById('password');
            const responsibilityCheckboxes = document.querySelectorAll(
                'input[name="adminOption[]"]'
            );

            function toggleField() {
                const isSubAdmin = select.value === 'true';

                passwordField.classList.toggle('hidden', !isSubAdmin);
                subAdminField.classList.toggle('hidden', !isSubAdmin);

                passwordInput.required = isSubAdmin;
                passwordConfirmationInput.required = isSubAdmin;

                passwordInput.disabled = !isSubAdmin;
                passwordConfirmationInput.disabled = !isSubAdmin;

                responsibilityCheckboxes.forEach(function(checkbox) {
                    checkbox.required = false;
                    checkbox.disabled = !isSubAdmin;

                    if (!isSubAdmin) {
                        checkbox.checked = false;
                    }
                });

                if (!isSubAdmin) {
                    passwordInput.value = '';
                    passwordConfirmationInput.value = '';
                }
            }
            form.addEventListener('submit', function(event) {
                const isSubAdmin = select.value === 'true';
                const hasResponsibility = [...responsibilityCheckboxes]
                    .some(checkbox => checkbox.checked);

                if (isSubAdmin && !hasResponsibility) {
                    event.preventDefault();
                    alert('Pilih minimal satu tanggung jawab untuk sub-admin.');
                }
            });

            select.addEventListener('change', toggleField);
            toggleField();
        });
    </script>

@endsection
