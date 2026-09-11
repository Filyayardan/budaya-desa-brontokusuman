@extends('admin.layouts.app')
@section('title', 'Tambah Subadmin')
@section('header', 'Tambah Subadmin')

@section('content')
    @php
        $selected = old('adminOption', []);
    @endphp
    <div class="max-w-xl">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <form id="create_subadmin_form" action="{{ route('admin.userManagement.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="password" value="{{ old('password') }}" id="password" required
                            class="w-full px-4 py-2.5 pr-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                        <button type="button" data-toggle-password="#password"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Masukkan Ulang Password <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            value="{{ old('password_confirmation') }}" required
                            class="w-full px-4 py-2.5 pr-11 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none">
                        <button type="button" data-toggle-password="#password_confirmation"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-6 space-y-4 border border-gray-300 rounded-lg p-4 bg-gray-50/50" id="subAdminField">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggung Jawab<span
                                class="text-red-500">*</span></label>
                        @foreach ($adminOptions as $group => $items)
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-3">{{ $group }}</h4>
                            @foreach ($items as $value => $label)
                                <label class="flex items-center space-x-3 cursor-pointer mb-1.5">
                                    <input type="checkbox" name="adminOption[]" value="{{ $value }}"
                                        {{ in_array($value, $selected) ? 'checked' : '' }}
                                        class="w-4 h-4 text-gold-600 rounded border-gray-300 focus:ring-gold-500">
                                    <span class="text-sm text-gray-700">{{ $label }}</span>
                                </label>
                            @endforeach
                        @endforeach
                        @if (empty($adminOptions))
                            <p class="text-xs text-gray-400">Belum ada kategori. Tambahkan Budaya/UMKM terlebih dahulu.</p>
                        @endif
                    </div>
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
            const responsibilityCheckboxes = document.querySelectorAll('input[name="adminOption[]"]');

            let hasResponsibility = false;

            function updateState() {
                hasResponsibility = [...responsibilityCheckboxes].some(cb => cb.checked);
            }

            responsibilityCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateState);
            });

            document.querySelectorAll('[data-toggle-password]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = document.querySelector(this.dataset.togglePassword);
                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    this.querySelector('i').className = 'fas ' + (isPassword ? 'fa-eye-slash' : 'fa-eye');
                });
            });

            form.addEventListener('submit', function(event) {
                if (!hasResponsibility) {
                    event.preventDefault();
                    alert('Pilih minimal satu tanggung jawab untuk sub-admin.');
                }
            });

            updateState();
        });
    </script>
@endsection