<?php

namespace App\Service;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use DateTimeImmutable;
use Exception;

class PartnerService
{
    public function __construct(private PartnerRepository $repository)
    {
    }

    /**
     * @param int $partnerId
     * @return Partner|Exception
     * @throws Exception
     */
    public function isPartnerFound(int $partnerId): Partner|Exception
    {
        $partner = $this->repository->find($partnerId);
        if (! $partner) {
            throw new Exception("Partner not found");
        }

        return $partner;
    }

    public function updatePartner(Partner $partner, array $payload): void
    {
        ! empty($payload['name']) && $partner->setName($payload['name']);
        ! empty($payload['email']) && $partner->setEmail($payload['email']);
        ! empty($payload['phone']) && $partner->setPhone($payload['phone']);
        ! empty($payload['cpf']) && $partner->setCpf($payload['cpf']);

        $partner->setUpdatedAt(new DateTimeImmutable);
        $this->repository->save($partner);
    }

    public function deletePartner(Partner $partner): void
    {
        $this->repository->delete($partner);
    }
}
