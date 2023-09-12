@props(['edit', 'where'])

<a href="{{ route($edit . '.edit', $where) }}" {!! $attributes->merge(['class'=>"bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-800"]) !!}>
    Edit
</a>
