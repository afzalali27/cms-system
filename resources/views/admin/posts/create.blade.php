<x-admin-master>
    @section('content')
        <h1>create post</h1>

        <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titile">Title:</label>
                <input name="title" type="text" placeholder="post title" class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="post_image">Image:</label>
                <input name="post_image" type="file" class="form-control-file" id="post_image">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    @endsection
</x-admin-master>
