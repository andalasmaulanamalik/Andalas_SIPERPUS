<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Pinjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Nama Buku</th>
                                <th scope="col">Status Pengembalian</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($loanDetails as $loanDetail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                
                                <td>{{ $loanDetail->book->title }}</td> <!-- Menampilkan nama buku -->
                                <td>
                                    @if ($loanDetail->is_return)
                                        Dikembalikan
                                    @else
                                        Belum Dikembalikan
                                    @endif
                                </td>
                                <td>
                                <x-primary-button>
                                    <a href="{{ route('return.create') }}">Kembalikan</a>
                                </x-primary-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
