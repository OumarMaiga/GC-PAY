<?php

    namespace App\Repositories;

    use App\Models\Services;

    class ServiceRepository extends ResourceRepository {

        public function __construct(Services $service) {
            $this->model = $service;
        }
        
    }