<?php

    namespace App\Repositories;

    use App\Models\Vignette;

    class VignetteRepository extends ResourceRepository {

        public function __construct(Vignette $vignette) {
            $this->model = $vignette;
        }
        
    }