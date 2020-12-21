@if(!empty($entry))
    @php
        /** @var \App\Models\Event\Event $entry */
        $event_id = $entry->getKey();
        $thirdPartySiteEvent = $entry->thirdPartySiteEvent; @endphp
        @if($thirdPartySiteEvent)
            @php
                $thirdPartySiteEventsService = new \App\Services\Admin\AccessToEventsDataService(); @endphp

            <div class="form-group col-xs-12">
                <label>{!! $field['label'] !!}</label>
                <div class="form-control">
                    <a href="{{ $thirdPartySiteEventsService->generatingURL($thirdPartySiteEvent) }}" target="_blank">
                        {{ $thirdPartySiteEventsService->generatingURL($thirdPartySiteEvent) }}
                    </a>
                </div>
            </div>
        @endif
@endif


