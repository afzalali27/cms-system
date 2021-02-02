<x-admin-master>
    @section('content')
        <h1>Edit post</h1>

        <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            {{-- patch or put is for update --}}
            @method('PATCH')
            <div class="form-group">
                <label for="titile">Title:</label>
                <input name="title" type="text" value="{{ $post->title }}" placeholder="post title" class="form-control"
                    id="title">
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control">
                                         {{ $post->body }}"
                                        </textarea>
            </div>
            <div class="form-group">
                <div><img src="{{ $post->post_image }}" height="100px" /> </div>
                <label for="post_image">Image:</label>
                <input name="post_image" type="file" class="form-control-file" id="post_image">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    @endsection
</x-admin-master>
