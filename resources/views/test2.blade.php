@include('test')
<div class="alert alert-primary" role="alert">
  2. Write a function to find a number that repeats 1 time in this array [4, 8, 9, 5, 8, 9, 4, 1, 9, 5]. The
  result should be “1”.
</div>
@if (count($arr) > 0)
@foreach ($arr as $value )
  {{ $value }}
@endforeach
@endif