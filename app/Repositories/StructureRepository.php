<?php

    namespace App\Repositories;

    use App\Models\Structure;

    class StructureRepository extends ResourceRepository {

        public function __construct(Structure $structure) {
            $this->model = $structure;
        }
        
    }