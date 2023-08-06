@include('test')
<div class="alert alert-primary" role="alert">
 1 . Write a function that can find the top 2 largest numbers of an array?
 E.g. giving an array [0, 6, 100, 46, 47], your function should return 100 and 47.
</div>
@if (count($arr) > 0)
@foreach ($arr as $value )
  {{ $value }}
@endforeach
@endif