<?php

declare(strict_types=1);

namespace App\Tests\DataFixtures\User;

use Component\User\Command\CreateUserCommand;
use Component\User\Model\User;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

final class UserFixtures extends AbstractFixture
{
    public const USER_JOHN_DOE_EMAIL = 'john.doe@example.com';
    public const USER_JOHN_DOE_ID = '018aec6c-bf5a-793a-9543-8641cc5e92df';
    public const USER_JESSICA_JONES_EMAIL = 'jessica.jones@netflix.com';
    public const USER_JESSICA_JONES_ID = '018aec6c-bfa0-7ba1-bba8-93489aece609';
    public const USER_EMMA_SMITH_EMAIL = 'emma.smith@yahoo.com';
    public const USER_EMMA_SMITH_ID = '018aec6c-bfc0-72fe-8dd0-2a9404e33004';
    public const USER_SEAN_BEAN_EMAIL = 'sean.bean@societe.fr';
    public const USER_SEAN_BEAN_ID = '018aec6c-bfe0-734d-b36c-a4191ff30d14';
    public const USER_BRIAN_COX_EMAIL = 'brian.cox@firm.ca';
    public const USER_BRIAN_COX_ID = '018aec6c-bfff-7d71-a60d-198df8b57c19';
    public const USER_FRANCIS_MITCHEL_EMAIL = 'francis.mitchel@holly.ee';
    public const USER_FRANCIS_MITCHEL_ID = '018aec6c-c01d-7565-9794-0fc2d15ca641';
    public const USER_DAN_WILSON_EMAIL = 'dan.wilson@sun.au';
    public const USER_DAN_WILSON_ID = '018aec6c-c03c-7610-975d-3474bc57e0e3';
    public const USER_MELODY_MACY_EMAIL = 'melody.macy@allto.de';
    public const USER_MELODY_MACY_ID = '018aec6c-c05d-7ced-a2a6-6d05d5efbdcf';
    public const USER_MIKAELA_COLLINS_EMAIL = 'mik@pex.com';
    public const USER_MIKAELA_COLLINS_ID = '018aec6c-c07f-78ec-86bf-6c9d36676103';
    public const USER_OLIVIA_WILD_EMAIL = 'olivia@corpmail.is';
    public const USER_OLIVIA_WILD_ID = '018aec6c-c09f-723a-84f8-10ea97f5c90d';
    public const USER_NEIL_OWEN_EMAIL = 'owen.neil@gmail.com';
    public const USER_NEIL_OWEN_ID = '018aec6c-c0be-750c-9589-a15f22e13346';

    public function load(ObjectManager $manager): void
    {
        $createdAt = new DateTimeImmutable();

        foreach ([
            UserFixtures::USER_JOHN_DOE_ID => UserFixtures::USER_JOHN_DOE_EMAIL,
            UserFixtures::USER_JESSICA_JONES_ID => UserFixtures::USER_JESSICA_JONES_EMAIL,
            UserFixtures::USER_EMMA_SMITH_ID => UserFixtures::USER_EMMA_SMITH_EMAIL,
            UserFixtures::USER_SEAN_BEAN_ID => UserFixtures::USER_SEAN_BEAN_EMAIL,
            UserFixtures::USER_BRIAN_COX_ID => UserFixtures::USER_BRIAN_COX_EMAIL,
            UserFixtures::USER_FRANCIS_MITCHEL_ID => UserFixtures::USER_FRANCIS_MITCHEL_EMAIL,
            UserFixtures::USER_DAN_WILSON_ID => UserFixtures::USER_DAN_WILSON_EMAIL,
            UserFixtures::USER_MELODY_MACY_ID => UserFixtures::USER_MELODY_MACY_EMAIL,
            UserFixtures::USER_MIKAELA_COLLINS_ID => UserFixtures::USER_MIKAELA_COLLINS_EMAIL,
            UserFixtures::USER_OLIVIA_WILD_ID => UserFixtures::USER_OLIVIA_WILD_EMAIL,
            UserFixtures::USER_NEIL_OWEN_ID => UserFixtures::USER_NEIL_OWEN_EMAIL,
                 ] as $id => $email) {
            $command = new CreateUserCommand($id, $email, $createdAt);
            $user = User::create($command);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
