<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mobil') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <h2 class="text-xl font-semibold mb-5">Edit Mobil</h2>

          <form class="max-w-xl" method="POST" action="{{ route('mobil.update', $mobil->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-5">
              <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
              </label>
              <input id="nama" name="nama"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukan nama mobil" required value="{{ old('nama', $mobil->nama) }}" />
              @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-5 mt-4">
              <label for="harga_sewa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Sewa / Hari
              </label>
              <input id="harga_sewa" name="harga_sewa" type="number"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukan harga sewa mobil" required value="{{ old('harga_sewa', $mobil->harga_sewa) }}" />
              @error('harga_sewa')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-5 mt-4 hidden">
              <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
              </label>
              <input id="jumlah" name="jumlah" type="number"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukan jumlah mobil" required value="{{ old('jumlah', $mobil->jumlah) }}" />
              @error('jumlah')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-5 mt-4">
              <label for="plat_nomor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plat Nomor
              </label>
              <input id="plat_nomor" name="plat_nomor" type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukan plat nomor mobil" required value="{{ old('plat_nomor', $mobil->plat_nomor) }}" />
              @error('plat_nomor')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
              <select id="status" name="status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option disabled {{ old('status', $mobil->status ?? '') == '' ? 'selected' : '' }}>Pilih status mobil
                </option>
                <option value="tersedia" {{ old('status', $mobil->status ?? '') == 'tersedia' ? 'selected' : '' }}>
                  Tersedia</option>
                <option value="tidak tersedia"
                  {{ old('status', $mobil->status ?? '') == 'tidak tersedia' ? 'selected' : '' }}>Tidak tersedia
                </option>
              </select>
              @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>


            <button type="submit"
              class="w-fit mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
          </form>


        </div>
      </div>
    </div>
  </div>
</x-app-layout>
