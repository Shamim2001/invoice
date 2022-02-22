<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot))
<img src="http://127.0.0.1:8000/img/logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
