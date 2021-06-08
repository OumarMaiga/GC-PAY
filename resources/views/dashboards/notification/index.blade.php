<x-dashboard-layout>
    <div class="container-xl">
        <div class="list-group">
            @foreach ($notifications as $notification)
                <a href="{{ route('notification.show', $notification->slug) }}" class="list-group-item list-group-item-action <?= ($notification->vue == false) ? "list-group-item-secondary" : "" ?>">{!! $notification->description !!}</a>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>