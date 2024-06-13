@php
	use App\Constants\ChatStatus;
@endphp
<x-badge value="{{ $status }}" :options="[
    (object) [
        'color' => 'green',
        'value' => ChatStatus::OPEN,
    ],
    (object) [
        'color' => 'red',
        'value' => ChatStatus::CLOSED,
    ],
]" />
