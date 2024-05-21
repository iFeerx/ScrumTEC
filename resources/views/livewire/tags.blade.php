<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @if ($estatus)
    <span class="tag {{ $color }}">{{ $estatus }}</span>
    @else
    <span class="tag bg-gray-500">Sin etiqueta</span>
    @endif
</div>