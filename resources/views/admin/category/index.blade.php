<x-admin-layout>
    <div class="container ml-3 pt-2 mr-1">
        <div>
            <a href="{{ route('admin.categories.create') }}">
                Create New Category
            </a>
        </div>

        <div class="mt-5 mr-1">
            <table class="table-auto w-full text-gray-500 dark:text-gray-400">
                <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Parent</th>
                    <th>#</th>
                </tr>
                </thead>

                <tbody>
                @foreach($categories as $cat)
                    <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                        <td>{{ $cat->id}}</td>
                        <td>{{ $cat->title }}</td>
                        <td>
                            {{ !empty($cat->parent) ? $cat->parent->title : '-' }}
                        </td>
                        <td>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                                  method="post"
                                  style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-700 text-xs hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                            <a href="{{ route('admin.categories.edit', $cat->id) }}"
                                    class="bg-red-700 ml-3 text-xs hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
                                Update
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
