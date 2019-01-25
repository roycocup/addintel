<h1>Post List</h1>

@foreach ($posts as $post)
    <p>
        {{ $post->title }} -- {{ $post->user->name }}
    </p>
    
@endforeach


