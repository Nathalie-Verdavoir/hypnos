<?php

namespace App\Security;

use App\Entity\Hotel;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class HotelVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';
    const CREATE = 'create';

    public function __construct(
        private Security $security,
    )
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::CREATE])) {
            return false;
        }

        // only vote on `Post` objects
        if (!$subject instanceof Hotel) {
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
        /** @var Hotel $hotel */
        $hotel = $subject;

        return match ($attribute) {
            self::VIEW => $this->canView($hotel, $user),
            self::EDIT => $this->canEdit($hotel, $user),
            self::CREATE => $this->canCreate($hotel, $user),
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

    private function canView(Hotel $hotel, User $user): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($hotel, $user) || $this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return false;
    }

    private function canEdit(Hotel $hotel, User $user): bool
    {
        // this assumes that the Post object has a `getOwner()` method
        return $user === $hotel->getGerant();
    }
}