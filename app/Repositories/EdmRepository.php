<?php

    namespace App\Repositories;

    use App\Models\Edm;

    class EdmRepository extends ResourceRepository {

        public function __construct(Edm $edm) {
            $this->model = $edm;
        }
        
    }