<?php

    namespace App\Repositories;

    use App\Models\Requete;

    class RequeteRepository extends ResourceRepository {

        public function __construct(Requete $requete) {
            $this->model = $requete;
        }
        
    }