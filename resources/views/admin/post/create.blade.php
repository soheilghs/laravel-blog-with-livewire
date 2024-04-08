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

        <form action="{{ route('admin.posts.store') }}"
              method="post" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title">
                    Title :
                </label>
                <input type="text" name="title" id="title">
            </div>

            <div class="mt-5">
                <label for="body"> Body : </label>
                <textarea class="form-control" id="body"
                          placeholder="Enter the Description"
                          rows="10" name="body"></textarea>
            </div>

            <div class="mt-5">
                <label for="category">
                    Category :
                </label>
                <select name="category" id="category">
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
                <label for="image">
                    Image :
                </label>
                <input type="file" name="image" id="image">
            </div>

            <div class="mt-5 mb-4">
                <button type="submit"
                        class="bg-red-700 hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
                    Submit
                </button>
            </div>
        </form>
    </div>

    @push('styles')
        <script src="{{ asset('assets/vendor/ckeditor5/ckeditor.js') }}"></script>
    @endpush

    @push('scripts')
        <script>
            ClassicEditor
                .create(document.querySelector('#body'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-admin-layout>

