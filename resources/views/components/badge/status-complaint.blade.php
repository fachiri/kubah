<x-badge value="{{ $status }}" :options="[
    (object) [
        'color' => 'blue',
        'value' => 'PENDING'
    ],
    (object) [
        'color' => 'yellow',
        'value' => 'IN PROGRESS'
    ],
    (object) [
        'color' => 'green',
        'value' => 'RESOLVED'
    ]
]" />
