@extends('admin.layouts.app')
@section('title', 'Tambah Subadmin')
@section('header', 'Tambah Subadmin')

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
        $selectedOptions = old('adminOption', $subAdmin->contents->pluck('judul')->toArray());
    @endphp
    <div class="max-w-xl">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <form id="create_subadmin_form"
                action="{{ route('admin.userManagement.update', $subAdmin) }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="email" value="{{ old('email', $subAdmin->username) }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>


                <div class="mb-4" id="passwordField">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password </label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                    <div class="hidden mb-4"id="passwordConfirmationInputField">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Masukkan Ulang Password <span
                                class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            value="{{ old('password_confirmation') }}" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                    </div>
                <div class="mb-6 space-y-2 border border-gray-300 rounded-lg p-3 bg-gray-50/50" id="subAdminField">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggung Jawab<span
                            class="text-red-500">*</span></label>
                    @foreach ($menu as $route => $item)
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="adminOption[]" value="{{ $route }}"
                                {{ in_array($route, $selectedOptions) ? 'checked' : '' }}
                                class="w-4 h-4 text-gold-600 rounded border-gray-300 focus:ring-gold-500">
                            <span class="text-sm text-gray-700">{{ $item['label'] }}</span>
                        </label>
                    @endforeach
                </div>
                <div class="flex items-center space-x-3">
                    <button type="submit" class="px-5 py-2.5 rounded-lg text-white text-sm font-medium"
                        style="background: linear-gradient(135deg, #d4a017, #b8860b);">Simpan</button>
                    <a href="{{ route('admin.userManagement.index') }}"
                        class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('create_subadmin_form');
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const passwordConfirmationInputField = document.getElementById('passwordConfirmationInputField');
            const passwordInput = document.getElementById('password');
            const responsibilityCheckboxes = document.querySelectorAll(
                'input[name="adminOption[]"]'
            );

            // function toggleField() {
            passwordInput.addEventListener('input', function() {
                const hasValue = passwordInput.value.trim().length > 0;
                passwordConfirmationInputField.classList.toggle('hidden', !hasValue);
                passwordConfirmationInput.required = hasValue;
                
            })
            let hasResponsibility = false;
            let selectedValues = [];

            function updateState() {
                const checkboxArray = [...responsibilityCheckboxes];

                // Memperbarui variabel boolean (apakah minimal ada 1 yang dicentang)
                hasResponsibility = checkboxArray.some(cb => cb.checked);

                // Memperbarui array nilai yang dipilih
                selectedValues = checkboxArray
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                // console.log('hasResponsibility:', hasResponsibility);
                // console.log('selectedValues:', selectedValues);
            }

            responsibilityCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateState);
            });
            // const hasResponsibility = [...responsibilityCheckboxes]
            //     .some(checkbox => checkbox.checked);
            // console.log(hasResponsibility)
            // if ( !hasResponsibility) {
            //     responsibilityCheckboxes.forEach(function(checkbox) {
            //         checkbox.required = true;
            //         checkbox.disabled = true;

            //         // if (!isSubAdmin) {
            //         //     checkbox.checked = false;
            //         // }
            //     });
            //     event.preventDefault();
            //     // alert('Pilih minimal satu tanggung jawab untuk sub-admin.');
            // }
            // }
            form.addEventListener('submit', function(event) {


                console.log("iloveyou")
                if (!hasResponsibility) {
                    event.preventDefault();
                    alert('Pilih minimal satu tanggung jawab untuk sub-admin.');
                }
            });

            updateState();
        });
    </script>

@endsection
