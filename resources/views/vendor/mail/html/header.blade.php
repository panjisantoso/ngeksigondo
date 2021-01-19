<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Diskominfos Bali')
<img src="https://diskominfos.baliprov.go.id/wp-content/uploads/2018/01/cropped-kominfofavico1-192x192.png" class="logo" alt="Diskominfos Bali">
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
