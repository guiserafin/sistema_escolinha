<?php

interface TemplateMethod{

    public function create($params);
    public function read($id);
    public function update($params, $id);
    public function delete($id);
    public function list();

}