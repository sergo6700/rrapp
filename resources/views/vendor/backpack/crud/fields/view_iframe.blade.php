@if(!empty($entry))
    @php /** @var \App\Models\Event\Event $entry */ @endphp
        @if($event_id = $entry->getKey())
            <div class="form-group col-xs-12">
                <label>{!! $field['label'] !!}</label>
                <div>
                    <textarea class="form-control" readonly name='{!! $field['name'] !!}'>&lt;iframe src="{{ route('registration.events.index', ['event' => $event_id]) }}" style="width: 100%; height: 1400px; border: none;" scrolling="no" frameborder="0"&gt;&lt;/iframe&gt;</textarea>
                </div>
            </div>
        @endif
@endif
