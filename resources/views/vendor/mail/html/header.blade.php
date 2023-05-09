@props(['url'])
<tr>
    <td class="header">
        <a href="https://heroes.my" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/heroes_logo.png'))) }}" class="logo" width="200px" alt="{{ $slot }}">
            @endif
        </a>
    </td>
</tr>