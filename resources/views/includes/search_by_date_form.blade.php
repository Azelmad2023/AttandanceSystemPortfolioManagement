{{-- <div>
    <form method="GET" action="{{ route('admin.search_by_date') }}">
        @csrf
        <label for="search_date">Search by Date</label>
        <input type="date" id="search_date" name="search_date">
        <button type="submit">Search</button>
    </form>
</div> --}}
<div class="mb-3">
    <form method="GET" action="{{ route('admin.search_by_date') }}" class="flex items-center">
        @csrf
        <label for="search_date" class="mr-2 mb-0">Recherche par date :</label>
        <input type="date" id="search_date" name="search_date"
            class="border rounded-md py-1 px-2 focus:outline-none focus:border-blue-500">
        <button type="submit"
            class="bg-blue-500 text-white py-1 px-4 ml-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 bold">Rechercher</button>
    </form>
</div>

{{-- <div class="mb-3">
    <form method="GET" action="{{ route('admin.search_by_date') }}" class="flex items-center">
        @csrf
        <label for="search_date" class="mr-2">Search by Date:</label>
        <input type="date" id="search_date" name="search_date"
            class="border rounded-md py-1 px-2 focus:outline-none focus:border-blue-500">
        <button type="submit"
            class="bg-blue-500 text-white py-1 px-4 ml-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 bold">Search</button>
    </form>
</div> --}}
