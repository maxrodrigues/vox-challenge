<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\Partner;
use App\Repository\CompanyRepository;
use App\Repository\PartnerRepository;
use DateTimeImmutable;
use Exception;

class CompanyService
{
    public function __construct(
        private CompanyRepository $repository,
        private PartnerRepository $partnerRepository,
    ){}

    /**
     * @param int $companyId
     * @return Company|Exception
     * @throws Exception
     */
    public function isCompanyFound(int $companyId): Company|Exception
    {
        $company = $this->repository->find($companyId);
        if (! $company) {
            throw new Exception("Company not found");
        }

        return $company;
    }

    public function createCompany(array $payload)
    {
        $company = new Company();
        $company
            ->setCompanyName($payload['company_name'])
            ->setTradeName($payload['trade_name'])
            ->setCnpj($payload['cnpj'])
            ->setEmail($payload['email'])
            ->setIsActive(true)
            ->setCreatedAt(new DateTimeImmutable)
            ->setUpdatedAt(new DateTimeImmutable);

        if ($payload['phone']) {
            $company->setPhone($payload['phone']);
        }

        $this->repository->save($company);
    }

    public function createCompanyAndPartner(array $payload)
    {
        $company = new Company();
        $company
            ->setCompanyName($payload['company_name'])
            ->setTradeName($payload['trade_name'])
            ->setCnpj($payload['cnpj'])
            ->setEmail($payload['email'])
            ->setIsActive(true)
            ->setCreatedAt(new DateTimeImmutable)
            ->setUpdatedAt(new DateTimeImmutable);

        if ($payload['phone']) {
            $company->setPhone($payload['phone']);
        }

        $partner = new Partner();
        $partner->setName($payload['partner']['name'])
            ->setEmail($payload['partner']['email'])
            ->setPhone($payload['partner']['phone'])
            ->setCpf($payload['partner']['cpf'])
            ->setIsActive(true)
            ->setCreatedAt(new DateTimeImmutable())
            ->setUpdatedAt(new DateTimeImmutable());

        $company->addPartner($partner);
        $this->repository->save($company);
        $this->partnerRepository->save($partner);
    }

    /**
     * @param Company $company
     * @return void
     */
    public function activeCompany(Company $company): void
    {
        $this->repository->updateCompanyStatus($company, true);
    }

    /**
     * @param Company $company
     * @return void
     */
    public function disableCompany(Company $company): void
    {
        $this->repository->updateCompanyStatus($company, false);
    }

    /**
     * @param Company $company
     * @return void
     */
    public function deleteCompany(Company $company): void
    {
        $this->repository->delete($company);
    }
}
