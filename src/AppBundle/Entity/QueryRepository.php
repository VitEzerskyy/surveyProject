<?php

namespace AppBundle\Entity;


Interface QueryRepository
{
    public function findById($id);
    public function getAll();
}