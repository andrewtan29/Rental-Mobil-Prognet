<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Pelanggan') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <h2 class="text-xl font-semibold mb-5">Tambah Pelanggan</h2>

          <form class="max-w-xl" method="POST" action="{{ route('pelanggan.create') }}">
            @csrf
            <div class="mb-5">
              <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
              </label>
              <input id="nama"
                name="nama"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukan nama pelanggan" required value="{{ old('nama') }}" />
              @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-5 mt-4">
              <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
              </label>
              <input id="alamat"
                name="alamat"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukan alamat pelanggan" required value="{{ old('alamat') }}" />
              @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-5 mt-4">
              <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. HP
              </label>
              <input id="no_hp"
                name="no_hp"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukan no. HP pelanggan" required value="{{ old('no_hp') }}" />
              @error('no_hp')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <button type="submit"
              class="w-fit mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
          </form>


        </div>
      </div>
    </div>
  </div>
</x-app-layout>
