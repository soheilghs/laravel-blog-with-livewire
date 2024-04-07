<x-admin-layout>
    <div class="container ml-3 pt-2 mr-1">

        @if ($errors->any())
            <div class="alert mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.category.store') }}"
              method="post">
            @csrf

            <div>
                <label for="title">
                    Title :
                </label>
                <input type="text" name="title" id="title">
            </div>

            <div class="mt-5">
                <label for="parent">
                    Parent :
                </label>
                <select name="parent" id="parent">
                    <option value="0">
                        Choose
                    </option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id}}">
                            {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-5">
                <button type="submit"
                        class="bg-red-700 hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
