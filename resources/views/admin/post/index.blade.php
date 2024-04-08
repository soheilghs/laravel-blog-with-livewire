<x-admin-layout>
    <div class="container ml-3 pt-2 mr-1">
        <div>
            <a href="{{ route('admin.posts.create') }}">
                Create New Post
            </a>
        </div>

        <div class="mt-5 mr-1">
            <table class="table-auto w-full text-gray-500 dark:text-gray-400">
                <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>#</th>
                </tr>
                </thead>

                <tbody>
                @foreach($posts as $post)
                    <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                        <td>{{ $post->id}}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->title }}</td>
                        <td style="text-align: center">
                            <a href="{{ asset("uploads/posts/{$post->image}") }}"
                               target="_blank">
                                <img src="{{ asset("uploads/posts/{$post->image}") }}"
                                     style="max-width: 70px;display: block;
                                      margin-left: auto; margin-right: auto;"
                                     alt="Post Image">
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}"
                                  method="post"
                                  style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-700 text-xs hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                            <a href="{{ route('admin.posts.edit', $post->id) }}"
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
