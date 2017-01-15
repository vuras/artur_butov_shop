<?php

namespace AppBundle\Entity;

/**
 * Description of EntityFactory
 *
 * @author Arturas
 */
class EntityFactory 
{
    public function createEntity($entity)
    {
        return new $entity;
    }
}
