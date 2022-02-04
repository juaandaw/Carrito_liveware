    @props(['type' => 'info', 'position' => 'bottom-4 right-4'])
@php
    $typeClasses = [
            'info'  => 'bg-blue-500 border-blue-700',
            'warning' => 'bg-yellow-500 border-blue-700',
            'error' => 'bg-red-500 border-blue-700',
            'success' => 'bg-green-500 border-blue-700',
][$type];

    $positionClasses = [
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'top-right' => 'top-40 right-4',
        'top-left' => 'top-4 left-4',
][$position];


@endphp

    <div class="{{$positionClasses}} fixed">
        <div class="{{$typeClasses}} max-w-xs text-white rounded-lg px-4 py-2">
            {{$slot}}
        </div>
    </div>
