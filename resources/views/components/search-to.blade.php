@props(['where'])


<form action="{{ route($where . '.search') }}" method="GET" class="flex items-center">
    <div class="relative flex items-center">
        <input type="search" name="query" class="border rounded-l-lg w-64 py-2 px-4 pl-10" placeholder="Search {{ ucfirst($where) }}...">
        <button type="submit" class="absolute left-0 top-0 h-full px-3 py-2 text-gray-600 dark:text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M14.293 13.293a6 6 0 111.414-1.414l5 5a1 1 0 01-1.414 1.414l-5-5zM10 16a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</form>
