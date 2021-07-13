
<tr>
<td class="header">
<a href="{{ route('home') }}" style="display: inline-block;">
@if (trim($slot) === 'GCPAY')
<img src="{{ asset('images/logo_small.png') }}" class="logo" style="background-color:blue; width:150px; " alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
