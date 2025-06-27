<?php

namespace App\Controller\Partner;

use App\Service\PartnerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteController extends AbstractController
{
    public function __construct(private PartnerService $partnerService)
    {
    }

    #[Route('api/partner/{partnerId}', name: 'app_partner_delete', methods: ['DELETE'])]
    public function __invoke(int $partnerId): JsonResponse
    {
        try {
            $partner = $this->partnerService->isPartnerFound($partnerId);
            $this->partnerService->deletePartner($partner);

            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'message' => 'Partner deleted successfully',
                ]
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'status' => 'error',
                'data' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
