<?php

    namespace App\Repositories;

    use App\Models\Rubrique;

    class RubriqueRepository extends ResourceRepository {

        public function __construct(Rubrique $rubrique) {
            $this->model = $rubrique;
        }
        
    }