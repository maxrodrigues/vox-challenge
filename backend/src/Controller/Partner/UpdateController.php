<?php

namespace App\Controller\Partner;

use App\Service\PartnerService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateController extends AbstractController
{
    public function __construct(private PartnerService $partnerService)
    {
        //
    }
    #[Route('/api/partner/{partnerId}', name: 'app_partner_update', methods: ['PUT'])]
    public function __invoke(int $partnerId, Request $request): JsonResponse
    {
        try {
            $data = $request->toArray();
            $partner = $this->partnerService->isPartnerFound($partnerId);

            $this->partnerService->updatePartner($partner, $data);

            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'message' => 'Partner successfully updated.',
                ],
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return new JsonResponse([
                'status' => 'error',
                'data' => [
                    'message' => $exception->getMessage(),
                ],
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
