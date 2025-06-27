<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $fake;

    public function load(ObjectManager $manager): void
    {
        $this->fake = Factory::create('pt_BR');

        for ($i = 0; $i < 10; $i++) {
            $company = new Company();
            $company->setCompanyName($this->fake->company)
                ->setTradeName($this->fake->company)
                ->setEmail($this->fake->safeEmail())
                ->setPhone($this->fake->phoneNumber())
                ->setIsActive(true)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->setCnpj($this->fake->cnpj);

            $manager->persist($company);
        }

        $manager->flush();
    }
}
