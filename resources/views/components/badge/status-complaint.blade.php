@php
	use App\Constants\ComplaintStatus;
@endphp
<x-badge value="{{ $status }}" :options="[
    (object) [
        'color' => 'blue',
        'value' => ComplaintStatus::PENDING,
    ],
    (object) [
        'color' => 'yellow',
        'value' => ComplaintStatus::IN_PROGRESS,
    ],
    (object) [
        'color' => 'green',
        'value' => ComplaintStatus::RESOLVED,
    ],
    (object) [
        'color' => 'red',
        'value' => ComplaintStatus::CANCELED,
    ],
]" />
