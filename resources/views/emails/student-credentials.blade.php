<!DOCTYPE html>
<html>
<body>

<p>Dear Aanknaad Users</p>
<p>Warm Greetings !!</p>
<p>"Welcome to the world of Mathematics, science & Technology"</p>

<p>It’s a pleasure connecting with you. Welcome to “Ganitalay” a part of Aanknaad – System for Assimilation of Mathematics.
This is an interactive & participative platform to learn & grow together by sharing one experiences. "Ganitalay", here mathematical fundamentals will be exhibited in a very user-friendly way & in simple terms. Here We follow three step mentoring process :</p>
<ul>
<li>Local Mentors: These are the people from the closet geographical area i.e their Pin Code</li>
<li>Syllabus Mentors: Helping Hands in Curricular difficulties</li>
<li>Renowned Mentors: Nationally acclaimed personalities guide the children about opportunities & probabilities across the world.</li>
<p>Thus, it will create a conducive environment to study mathematics in a more conceptual way. Aanknaad subscribers get free lifetime access to” Ganitalay”. Renowned mathematicians and our subject experts will certainly solve/clarify discrepancies raised on this platform.</p>

@if($details['user_type']== 4 )
      <p>Please find here your username - {{$details['user_name']}}</p> 
      <p>Password - {{$details['password']}}</p>
@else
      <p>Please find here your username – {{$details['email']}}</p> 
      <p>Password - {{$details['password']}}</p>  
@endif 


<strong>Thank you.</strong>

</body>
</html>
