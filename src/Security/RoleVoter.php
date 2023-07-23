<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class RoleVoter extends Voter
{
    // these strings are just invented: you can use anything
    const ADMIN_GERANT = 'admin_gerant';
    const GERANT_CLIENT = 'gerant_client';
    const CREATE = 'create';

    public function __construct(
        private Security $security,
    )
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::ADMIN_GERANT, self::GERANT_CLIENT, self::CREATE])) {
            return false;
        }

        // only vote on `Post` objects
        if (!$subject) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to `supports()`
        /** @var User $userSubject */
        $userSubject = $subject;

        return match ($attribute) {
            self::ADMIN_GERANT => $this->canAdminGerant($user),
            self::GERANT_CLIENT => $this->canGerantClient($user),
            self::CREATE => $this->canCreate($userSubject, $user),
            default => throw new \LogicException('This code should not be reached!')
        };
    }

    private function canCreate(User $user): bool
    {
        // if they can edit, they can view
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return false;
    }

    private function canAdminGerant(User $user): bool
    {
        if ($this->security->isGranted('ROLE_ADMIN') || $this->security->isGranted('ROLE_GERANT')) {
            return true;
        }

        return false;
    }

    private function canGerantClient(User $user): bool
    {
        if ($this->security->isGranted('ROLE_CLIENT') || $this->security->isGranted('ROLE_GERANT')) {
            return true;
        }

        return false;
    }
}