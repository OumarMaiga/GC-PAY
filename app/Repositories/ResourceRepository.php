<?php

    namespace App\Repositories;

    abstract class ResourceRepository {
        protected $model;
        
        public function get() {
            return $this->model->get();
        }

        public function getByEmail($email) {
            return $this->model->where('email', $email)->first();
        }

        public function store(Array $inputs) {
            return $this->model->create($inputs);
        }

        public function getById($id) {
            return $this->model->findOrFail($id);
        }

        public function update($id, Array $inputs) {
            $this->getById($id)->fill($inputs)->save();
        }

        public function destroy($id) {
            $this->getById($id)->delete();
        }
    }