<?php
// tests/Entity/UserTest.php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetterAndSetter()
    {
        $user = new User();

        // Définition de données de test
        $email = 'test@test.com';
        $password = 'password';
        $roles = ['ROLE_USER'];
        $lastname = 'Doe';
        $firstname = 'John';
        $subscription = null;
        $createdAt = new \DateTimeImmutable();
        $updatedAt = new \DateTimeImmutable();


        // Utilisation des setters
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRoles($roles);
        $user->setLastname($lastname);
        $user->setFirstname($firstname);
        $user->setSubscription($subscription);
        $user->setCreatedAt($createdAt);
        $user->setUpdatedAt($updatedAt);

        // Vérification des getters
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
        $this->assertEquals($roles, $user->getRoles());
        $this->assertEquals($lastname, $user->getLastname());
        $this->assertEquals($firstname, $user->getFirstname());
        $this->assertEquals($subscription, $user->getSubscription());
        $this->assertEquals($createdAt, $user->getCreatedAt());
        $this->assertEquals($updatedAt, $user->getUpdatedAt());

    }
}