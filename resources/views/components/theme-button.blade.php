@props(['href' => '#', 'text' => 'Button', 'icon' => null, 'secondary' => false, 'type' => 'button', 'class' => ''])
<a {{ $type === 'submit' ? 'type=submit' : '' }} href="{{ $href }}" class="theme-btn8 {{ $secondary ? 'theme-btn8-secondary' : '' }} {{ $class }}">
    @if ($icon)
        <i class="fas {{ $icon }} me-2"></i>
    @endif
    <span class="theme-btn8__text">{{ $text }}</span>
</a>