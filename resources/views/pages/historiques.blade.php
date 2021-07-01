<x-app-layout>
    <div class="container-fluid">
        <div class="list-group mt-2">
            @foreach ($historiques as $historique)
                <a href="{{ route('notification.detail', $historique->slug) }}" class="list-link">
                    <div class="list-group-item list-group-item-action <?= ($historique->vue == false) ? "list-group-item-unseen" : "" ?>">
                        <div class="row">
                            <div class="col-sm-10">
                                {!! $historique->description !!}
                            </div>
                            <div class="col-sm-2 d-flex justify-content-end">
                                {!! custom_date($historique->created_at) !!}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>