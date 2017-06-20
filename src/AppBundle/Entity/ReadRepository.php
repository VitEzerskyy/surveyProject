<?php

namespace AppBundle\Entity;


Interface ReadRepository
{
    public function findById($id);
    public function getAll();
}