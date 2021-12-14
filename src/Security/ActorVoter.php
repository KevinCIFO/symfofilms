<?php

namespace App\Security;

use App\Entity\Actor;
use App\Entity\User;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ActorVoter extends Voter {
    private $security, $operaciones;

    public function __construct(Security $security) {
        $this->security = $security;

        $this->operaciones = ['create', 'edit', 'delete'];
    }

    protected function supports(String $attribute, $subject): bool {
        if(!in_array($attribute, $this->operaciones)) {
            return false;
        }

        if(!$subject instanceof Actor) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(String $attribute, $actor, TokenInterface $token): bool {
        $user = $token->getUser();

        if(!$user instanceof User) {
            return false;
        }

        $method = 'can' .ucfirst($attribute);

        return $this->$method($actor, $user);
    }

    private function canCreate(Actor $actor, User $user): bool {
        return true;
    }

    private function canEdit(Actor $actor, User $user): bool {
        return true;
    }
    
    private function canDelete(Actor $actor, User $user): bool {
        return $this->canEdit($actor, $user);
    }
}