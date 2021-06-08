<?php

    namespace App\Repositories;

    use App\Models\Notification;

    class NotificationRepository extends ResourceRepository {

        public function __construct(Notification $notification) {
            $this->model = $notification;
        }
        
    }