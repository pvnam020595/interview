@include('test')
<div class="alert alert-primary" role="alert">
  3.Implement an ATM algorithm to serve a requested amount and use a minimum number of bank
notes. Available bank notes are $50, $10, $5, $1. The requested amount is $2018.
</div>
@if (count($arr) > 0)
@foreach ($arr as $value )
  {{ $value }}
@endforeach
@endif