<?php

namespace Livraria\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {

    public function findByEmailAndPassword($email, $password) {

        $user = $this->findOneByEmail($email);
        if ($user) {
            $hashSenha = $user->encryptPassword($password);

            if ($hashSenha == $user->getPassword()) {
                return $user;
            }
            else
                return false;
        }
        else
            return false;
    }

}
