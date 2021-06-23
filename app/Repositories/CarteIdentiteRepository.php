<?php

    namespace App\Repositories;

    use App\Models\CarteIdentite;

    class CarteIdentiteRepository extends ResourceRepository {

        public function __construct(CarteIdentite $carteIdentite) {
            $this->model = $carteIdentite;
        }
        
    }