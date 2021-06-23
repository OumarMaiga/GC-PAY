<?php

    namespace App\Repositories;

    use App\Models\Somagep;

    class SomagepRepository extends ResourceRepository {

        public function __construct(Somagep $somagep) {
            $this->model = $somagep;
        }
        
    }