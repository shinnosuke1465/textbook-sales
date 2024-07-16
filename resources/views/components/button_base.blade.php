@if ($type === 'delete')
    <a href="#" data-id="{{ $textbook->id }}" class="c-button-base c-button-base--delete js-delete">
        {{ $text }}
    </a>
@else
    <button type="submit" class="c-button-base">
        {{ $text }}
    </button>
@endif
