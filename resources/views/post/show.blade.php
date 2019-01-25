<h1>Post Detail</h1>

<h2>{{ $post->title }}</h2>
<small>Posted by {{$post->user->name }}</small>

<h2>Comments</h2>
@foreach ($post->comments as $comment)
<p>{{ $comment->text }} </p> <small>{{ $comment->user->name}} </small>

    
@endforeach


