<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('loan.store') }}" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf
                        <div class="max-w-xl">
                            <x-input-label for="user_id" value="Nama Peminjam" />
                            <x-text-input id="user_id" type="hidden" name="user_id" class="mt-1 block w-full"
                                value="{{ auth()->user()->id }}" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="loan_at" value="Tanggal Peminjaman" />
                            <x-text-input id="loan_at" type="date" name="loan_at" class="mt-1 block w-full"
                                value="{{ date('Y-m-d') }}" required />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="return_at" value="Tanggal Pengembalian" />
                            <x-text-input id="return_at" type="date" name="return_at" class="mt-1 block w-full"
                                value="{{ date('Y-m-d') }}" required />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="book_ids" value="Buku Yang Dipinjam" />
                            <x-select-input id="book_ids" name="book_ids[]" class="mt-1 block w-full" required>
                                @if($selectedBook)
                                    <option value="{{ $selectedBook->id }}" selected>{{ $selectedBook->title }}</option>
                                @endif
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ $selectedBook && $selectedBook->id === $book->id ? 'selected' : '' }}>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </x-select-input>
                        </div>
                        <x-secondary-button tag="a" href="{{ route('loan') }}">Cancel</x-secondary-button>
                        <x-primary-button name="save" type="submit">Pinjam</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
