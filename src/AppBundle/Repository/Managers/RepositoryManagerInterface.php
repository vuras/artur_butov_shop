<?php

namespace AppBundle\Repository\Managers;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * @author Arturas
 */
interface RepositoryManagerInterface 
{
    /**
     * Gets all records of user, if not specified gets all
     * 
     * @param UserInterface $user
     */
    public function getAll(UserInterface $user = null);
    
    /**
     * Gets records by ID
     * 
     * @param int $id
     */
    public function getById($id);
}
