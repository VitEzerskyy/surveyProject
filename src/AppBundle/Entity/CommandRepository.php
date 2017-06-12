<?php

namespace AppBundle\Entity;


Interface CommandRepository
{
    public function save($object);
    public function remove($object);
}