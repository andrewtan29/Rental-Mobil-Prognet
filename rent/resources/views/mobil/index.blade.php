<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mobil') }}
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
            <a type="button" href="{{ route('mobil.create.view') }}"
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

          {{-- Filter by Status --}}
          {{-- <div class="flex justify-between items-center mb-4 mt-4">
            
            <form method="GET" action="{{ route('mobil.index.view') }}" id="status-filter-form"
              class="flex items-center">
              <label for="status" class="text-sm font-medium text-gray-700 mr-2">Filter by Status:</label>
              <select name="status" id="status"
                class="block w-48 p-2 border rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                <option value="">All</option>
                <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak tersedia" {{ request('status') === 'tidak tersedia' ? 'selected' : '' }}>Tidak
                  Tersedia</option>
                <option value="sedang disewa" {{ request('status') === 'sedang disewa' ? 'selected' : '' }}>Disewakan</option>
              </select>
            </form>
          </div> --}}


          {{-- @if (request('search'))
            <div class="mt-4 flex gap-2">
              <h3 class="font-medium text-gray-500 whitespace-nowrap dark:text-white">
                Menampilkan hasil pencarian untuk
                <span class="font-semibold text-gray-900 dark:text-white">
                  "{{ request('search') }}"
                </span>
              </h3>
              <a href="{{ route('mobil.index.view') }}" class="text-red-600  text-xs underline pt-1">reset</a>
            </div>
          @endif --}}

          {{-- table --}}
          @if ($mobils->isEmpty())
            <div class="text-center mt-8">
              <p class="text-gray-500 dark:text-gray-400">Tidak ada data 😋</p>
            </div>
          @else
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      No
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Plat Nomor
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Harga Sewa / Hari
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                      Jumlah
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                      Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($mobils as $mobil)
                    <tr
                      class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}.
                      </th>
                      <td class="px-6 py-4">
                        {{ $mobil->plat_nomor }}
                      </td>
                      <td class="px-6 py-4">
                        {{ $mobil->nama }}
                      </td>
                      <td class="px-6 py-4">
                        Rp. {{ number_format($mobil->harga_sewa, 0, ',', '.') }} </td>
                      {{-- <td class="px-6 py-4">
                        {{ $mobil->jumlah }}
                      </td> --}}
                      <td class="px-6 py-4">
                        @if ($mobil->status === 'tersedia')
                          <span
                            class="inline-block px-2 py-1 text-xs font-semibold leading-none text-green-800 bg-green-200 rounded-full dark:text-green-100 dark:bg-green-600">tersedia</span>
                        @elseif ($mobil->status === 'tidak tersedia')
                          <span
                            class="inline-block px-2 py-1 text-xs font-semibold leading-none text-red-800 bg-red-200 rounded-full dark:text-red-100 dark:bg-red-600">tidak
                            tersedia</span>
                        @else
                          <span
                            class="inline-block px-2 py-1 text-xs font-semibold leading-none text-yellow-800 bg-yellow-200 rounded-full dark:text-yellow-100 dark:bg-yellow-600">disewakan</span>
                        @endif
                      </td>
                      <td class="px-6 py-4 text-center">
                        <div class="inline-flex justify-center items-center space-x-2">
                          {{-- if status not tersedia and not tidak tersedia, hide --}}
                          @if ($mobil->status !== 'sedang disewa')
                            <a href="{{ route('mobil.edit.view', $mobil->id) }}"
                              class="inline-flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium
                                rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                          @endif
                          <button type="button"
                            class="inline-flex items-center justify-center text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium
                                rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 delete-btn"
                            data-name="{{ $mobil->nama }}" data-url="{{ route('mobil.delete', $mobil->id) }}">
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
          window.location.href = `/mobil?search=${encodeURIComponent(query)}`;
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const statusDropdown = document.getElementById('status');

      // Submit the form when the dropdown value changes
      statusDropdown.addEventListener('change', function() {
        document.getElementById('status-filter-form').submit();
      });
    });
  </script>

</x-app-layout>
