<?php

namespace App\Repository;

use App\Entity\Partner;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Partner>
 */
class PartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $manager)
    {
        parent::__construct($registry, Partner::class);
    }

    public function save(Partner $partner): void
    {
        $this->manager->persist($partner);
        $this->manager->flush();
    }

    public function delete(Partner $partner): void
    {
        $this->manager->remove($partner);
        $this->manager->flush();
    }

    public function createNewPartner(array $payload): void
    {
        $partner = new Partner();
        $partner->setName($payload['name'])
            ->setEmail($payload['email'])
            ->setPhone($payload['phone'])
            ->setCpf($payload['cpf'])
            ->setIsActive(true)
            ->setCreatedAt(new DateTimeImmutable())
            ->setUpdatedAt(new DateTimeImmutable());

        $this->manager->persist($partner);
        $this->manager->flush();
    }

    //    /**
    //     * @return Partner[] Returns an array of Partner objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Partner
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
