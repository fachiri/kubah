<x-badge value="{{ $status }}" :options="[
    (object) [
        'color' => 'green',
        'value' => 'OPEN',
    ],
    (object) [
        'color' => 'red',
        'value' => 'CLOSED',
    ],
]" />
