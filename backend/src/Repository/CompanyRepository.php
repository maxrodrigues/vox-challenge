<?php

namespace App\Repository;

use App\Entity\Company;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 */
class CompanyRepository extends ServiceEntityRepository
{

    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $manager,
    )
    {
        parent::__construct($registry, Company::class);
    }

    public function findAllActiveCompanies(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.isActive = true')
            ->orderBy('c.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function save(Company $company): void
    {
        $this->manager->persist($company);
        $this->manager->flush();
    }

    /**
     * @param Company $company
     * @param array $payload
     * @return void
     */
    public function updateCompany(Company $company, array $payload): void
    {
        ! empty($payload['company_name']) && $company->setCompanyName($payload['company_name']);
        ! empty($payload['trade_name']) && $company->setTradeName($payload['trade_name']);
        ! empty($payload['cnpj']) && $company->setCnpj($payload['cnpj']);
        ! empty($payload['email']) && $company->setEmail($payload['email']);
        ! empty($payload['phone']) && $company->setPhone($payload['phone']);
        $company->setUpdatedAt(new DateTimeImmutable);

        $this->save($company);
    }

    /**
     * @param Company $company
     * @param bool $status
     * @return void
     */
    public function updateCompanyStatus(Company $company, bool $status): void
    {
        $company->setIsActive($status);
        $this->save($company);
    }

    /**
     * @param Company $company
     * @return void
     */
    public function delete(Company $company): void
    {
        $this->manager->remove($company);
        $this->manager->flush();
    }

    //    /**
    //     * @return Company[] Returns an array of Company objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Company
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
