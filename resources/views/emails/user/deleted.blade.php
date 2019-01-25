@component('mail::message')
<h3>Hi {{$name}}<h3>,
<p>
	as per your request, your account data has been deleted from our records. <br>
	We’re sorry to see you go, but you can always come back if you change your mind.		
</p>
<small>
	Best regards,<br>
	{{ config('app.company') }} Team.
</small>
@endcomponent

