<?php

    namespace App\Repositories;

    use App\Models\Impot;

    class ImpotRepository extends ResourceRepository {

        public function __construct(Impot $impot) {
            $this->model = $impot;
        }
        
    }