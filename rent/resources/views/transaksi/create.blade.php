<x-app-layout>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Transaksi') }}
    </h2>
  </x-slot>

  @if (session('success'))
    <div id="flash-message"
      class="mx-auto w-full text-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
      role="alert">
      <strong class="font-bold">Success!</strong>
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
  @endif

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <h2 class="text-xl font-semibold mb-5">Tambah transaksi</h2>

            <form class="max-w-xl" method="POST" action="{{ route('transaksi.create') }}">
              @csrf

              <div class="mb-5 mt-4">
                <label for="pelanggan"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pelanggan</label>
                <select id="pelanggan" name="id_pelanggan"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option disabled selected>Pilih pelanggan</option>
                  @foreach ($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}
                    </option>
                  @endforeach
                </select>
                @error('id_pelanggan')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>

              <div class="mb-5 mt-4">
                <div class="flex items-center gap-1  mb-2">
                  <label for="mobil" class="block text-sm font-medium text-gray-900 dark:text-white">Mobil</label>
                  <p class="text-xs font-medium text-gray-500 italic dark:text-white">(jika mobil tidak ada, berarti
                    sedang disewakan/tidak tersedia)</p>
                </div>
                <select id="mobil" name="id_mobil"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option disabled selected>Pilih mobil yang tersedia</option>
                  @foreach ($mobils as $mobil)
                    <option value="{{ $mobil->id }}">
                      [{{ $mobil->plat_nomor }}]
                      {{ $mobil->nama }}
                      - Rp. {{ number_format($mobil->harga_sewa, 0, ',', '.') }}
                    </option>
                  @endforeach
                </select>
                @error('id_mobil')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>


              <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Tanggal Sewa</label>
              <div id="date-range-picker" date-rangepicker class="flex items-center">
                <div class="relative">
                  <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                  </div>
                  <input id="datepicker-range-start" name="tanggal_sewa" type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date start">
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div class="relative">
                  <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                  </div>
                  <input id="datepicker-range-end" name="tanggal_kembali" type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date end">
                </div>
              </div>
              @error('tanggal_sewa')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
              @error('tanggal_kembali')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror

              <button type="submit"
                class="w-fit mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>



        </div>
      </div>
    </div>
  </div>

</x-app-layout>
