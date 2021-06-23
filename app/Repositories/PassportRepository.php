<?php

    namespace App\Repositories;

    use App\Models\Passport;

    class PassportRepository extends ResourceRepository {

        public function __construct(Passport $passport) {
            $this->model = $passport;
        }
        
    }