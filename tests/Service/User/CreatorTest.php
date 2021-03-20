<?php

namespace App\Tests\Service\User;

use App\Entity\User;
use App\Service\User\Creator;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreatorTest extends TestCase
{
    const ENCODED_PASS = 'adanfnasndfklasdcamkfemarpgm32por4';

    public function userDataProvider(): array
    {
        return [
            ['sampleName', 'plainPass'],
            ['someName', 'pass123456']
        ];
    }

    /**
     * @dataProvider userDataProvider
     */
    public function testSomething(string $name, string $pass): void
    {
        $user = $this->createUser($name, $pass);
        $creator = $this->getUserCreator();

        $this->assertNotNull($user->getPlainPassword());
        $this->assertFalse($user->getEnabled());
        $this->assertIsString($user->getUsername());

        $creator->create($user);

        $this->assertNull($user->getPlainPassword());
        $this->assertTrue($user->getEnabled());
        $this->assertIsString($user->getPassword());
        $this->assertIsString($user->getUsername());

        $this->assertTrue(true);
    }

    private function getUserCreator(): Creator
    {
        $emMock = $this->getMockBuilder(EntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $emMock->expects($this->once())->method('persist');
        $emMock->expects($this->once())->method('flush');

        $passEncoderMock = $this->getMockBuilder(UserPasswordEncoderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $passEncoderMock->method('encodePassword')->willReturn(self::ENCODED_PASS);

        return new Creator($emMock, $passEncoderMock);
    }

    private function createUser(string $name, string $pass):User
    {
        $user = new User();
        $user->setUsername($name);
        $user->setPlainPassword($pass);

        return $user;
    }
}
