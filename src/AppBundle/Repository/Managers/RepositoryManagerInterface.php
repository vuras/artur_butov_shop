<?php

namespace AppBundle\Repository\Managers;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * @author Arturas
 */
interface RepositoryManagerInterface 
{
    public function getAll(UserInterface $user = null);
}
