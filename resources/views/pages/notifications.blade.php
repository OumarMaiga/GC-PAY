<x-app-layout>
    <div class="container-fluid">
        <div class="list-group mt-2">
            @foreach ($notifications as $notification)
                <a href="{{ route('notification.detail', $notification->slug) }}" class="list-link">
                    <div class="list-group-item list-group-item-action <?= ($notification->vue == false) ? "list-group-item-unseen" : "" ?>">
                        <div class="row">
                            <div class="col-sm-10">
                                {!! $notification->description !!}
                            </div>
                            <div class="col-sm-2 d-flex justify-content-end">
                                {!! custom_date($notification->created_at) !!}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>