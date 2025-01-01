<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Pelanggan') }}
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
  @if (session('error'))
    <div id="flash-message"
      class="mx-auto w-full text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
      role="alert">
      <strong class="font-bold">Error!</strong>
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
  @endif

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

          <div class="flex justify-between">
            {{-- ADD BUTTON --}}
            <a type="button" href="{{ route('pelanggan.create.view') }}"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
              Data
            </a>

            {{-- SEARCH --}}
            {{-- <div class="flex gap-3">
              <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                  <div
                    class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                    </svg>
                  </div>
                  <input type="text" id="table-search"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
                </div>
              </div>
              <button id="search-button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Search</button>
            </div> --}}

          </div>

          {{-- @if (request('search'))
            <div class="mt-4 flex gap-2">
              <h3 class="font-medium text-gray-500 whitespace-nowrap dark:text-white">
                Menampilkan hasil pencarian untuk
                <span class="font-semibold text-gray-900 dark:text-white">
                  "{{ request('search') }}"
                </span>
              </h3>
              <a href="{{ route('pelanggan.index.view') }}" class="text-red-600  text-xs underline pt-1">reset</a>
            </div>
          @endif --}}

          {{-- table --}}
          @if ($pelanggans->isEmpty())
            <div class="text-center mt-8">
              <p class="text-gray-500 dark:text-gray-400">Tidak ada data 😋</p>
            </div>
          @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">No. Telp</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pelanggans as $pelangan)
                    <tr
                      class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}.
                      </th>
                      <td class="px-6 py-4">{{ $pelangan->nama }}</td>
                      <td class="px-6 py-4">{{ $pelangan->alamat }}</td>
                      <td class="px-6 py-4">{{ $pelangan->no_hp }}</td>
                      {{-- <td class="flex items-center px-6 py-4">
                        <a href="{{ route('pelanggan.edit.view', $pelangan->id) }}"
                          class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <button type="button"
                          class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3 delete-btn"
                          data-name="{{ $pelangan->nama }}" data-url="{{ route('pelanggan.delete', $pelangan->id) }}">
                          Remove
                        </button>
                      </td> --}}
                      <td class="px-6 py-4 ">
                        <div class="inline-flex space-x-2">
                          <a href="{{ route('pelanggan.edit.view', $pelangan->id) }}"
                            class="inline-flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium
                                rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <i class="fa-solid fa-pen-to-square"></i>
                          </a>
                          <button type="button"
                            class="inline-flex items-center justify-center text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium
                                rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 delete-btn"
                            data-name="{{ $pelangan->nama }}"
                            data-url="{{ route('pelanggan.delete', $pelangan->id) }}">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif

        </div>
      </div>
    </div>
  </div>

  {{-- Delete Confirmation Modal --}}
  <div id="delete-modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
      <h3 class="text-lg font-medium text-gray-800 mb-4">Delete Confirmation</h3>
      <p class="text-gray-600 mb-6" id="modal-text"></p>
      <div class="flex justify-end gap-4">
        <button id="cancel-btn"
          class="text-gray-600 bg-gray-200 hover:bg-gray-300 focus:outline-none px-4 py-2 rounded">Cancel</button>
        <a id="confirm-btn"
          class="text-white bg-red-600 hover:bg-red-700 focus:outline-none px-4 py-2 rounded">Delete</a>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const flashMessage = document.getElementById('flash-message');
      if (flashMessage) {
        setTimeout(() => {
          flashMessage.style.display = 'none';
        }, 3000);
      }

      const deleteButtons = document.querySelectorAll('.delete-btn');
      const deleteModal = document.getElementById('delete-modal');
      const modalText = document.getElementById('modal-text');
      const confirmBtn = document.getElementById('confirm-btn');
      const cancelBtn = document.getElementById('cancel-btn');

      deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
          const name = this.dataset.name;
          const url = this.dataset.url;
          modalText.textContent = `Are you sure you want to delete ${name}?`;
          confirmBtn.setAttribute('href', url);
          deleteModal.classList.remove('hidden');
        });
      });

      cancelBtn.addEventListener('click', function() {
        deleteModal.classList.add('hidden');
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('table-search');
      const searchButton = document.getElementById('search-button');

      const performSearch = () => {
        const query = searchInput.value.trim();
        if (query) {
          window.location.href = `/pelanggan?search=${encodeURIComponent(query)}`;
        }
      };

      searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
          event.preventDefault();
          performSearch();
        }
      });

      searchButton.addEventListener('click', function() {
        performSearch();
      });
    });
  </script>
</x-app-layout>
