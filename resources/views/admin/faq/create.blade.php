@extends('admin.layouts.app')
@section('title', 'Tambah FAQ')
@section('header', 'Tambah FAQ')

@section('content')
    <div class="container mx-auto px-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.faq.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="question" class="block text-gray-700 text-sm font-bold mb-2">Pertanyaan:</label>
                    <input type="text" name="question" id="question"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none"
                        value="{{ old('question') }}" required>
                    @error('question')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="answer" class="block text-gray-700 text-sm font-bold mb-2">Jawaban:</label>
                    <textarea name="answer" id="answer" rows="5"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-gold-500 outline-none"
                        required>{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('admin.faq.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 mr-2">Batal</a>
                    <button type="submit" class="px-4 py-2 rounded-lg text-white text-sm font-medium"
                        style="background: linear-gradient(135deg, #d4a017, #b8860b);">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
