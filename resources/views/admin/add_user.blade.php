@extends('admin.layouts.app')

@section('content')
    <div class="content flex flex-col w-full gap-8 py-8 px-10 flex-1">
        <div class="flex gap-8 w-full items-center justify-center">
            <div class="w-2/3">
                <x-display>Tambah Pengguna</x-display>
                <x-breadcrumb>
                    Admin &gt; <a href="{{ route('admin.users') }}" class="text-green-700 hover:underline">Kelola Data Pengguna</a> &gt; <span class="text-black">Tambah Pengguna</span>
                </x-breadcrumb>
            </div>
            <div class="w-1/3">
                <img src="{{ asset('images/logo-fill.png') }}" alt="Pilastik Logo" class="w-auto h-20 ml-auto">
            </div>
        </div>
        <div class="flex flex-1 gap-8 w-full">
            <x-card class="w-full flex-col">
                <form action="{{ route('user.store') }}" method="POST" class="space-y-6 w-full max-w-lg mx-auto">
                    @csrf
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Nama</label>
                        <input name="name" type="text" placeholder="Nama"
                            class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Email</label>
                        <input name="email" type="email" placeholder="Email"
                            class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Password</label>
                        <input name="password" type="password" placeholder="Password"
                            class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Posisi</label>
                        <input name="role" type="text" placeholder="Posisi"
                            class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">No. Telpon</label>
                        <input name="phone" type="text" placeholder="No. Telpon"
                            class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none" required>
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.users') }}" class="bg-gray-300 px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-grass text-white px-4 py-2 rounded-md">Simpan</button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
@endsection