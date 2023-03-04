<ul class="data-tree list-group {{ isset($child) ? 'hide' : '' }}">
    @forelse($data as $item => $itemData)
        <li class="list-group-item">
            @if(is_array($itemData))
                <a href="javascript:void(0)" class="show-item">{{ is_numeric($item) ? 'Item ' . (++$item) : ucfirst($item) }}</a>
                @include('json.show', ['data' => $itemData, 'child' => true ])
            @else
                <strong>{{ ucfirst($item) }}:</strong>
                <span>{{$itemData}}</span>
            @endif
        </li>

    @empty
        <li class="list-group-item">
            Empty
        </li>
    @endforelse
</ul>