@foreach ($posts as $post)
    <p>
        {{ $post->title }} -- {{ $post->user->name }}
    </p>
    
@endforeach


