<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachReferralRequest;
use App\Http\Resources\EarningsSummaryResource;
use App\Http\Resources\MyReferralResource;
use App\Http\Resources\ReferralResource;
use App\Models\Master;
use App\UseCases\Referral\AttachReferral\AttachReferralDTO;
use App\UseCases\Referral\AttachReferral\AttachReferralUseCase;
use App\UseCases\Referral\GetEarningsSummary\GetEarningsSummaryDTO;
use App\UseCases\Referral\GetEarningsSummary\GetEarningsSummaryUseCase;
use App\UseCases\Referral\GetMyReferrals\GetMyReferralsDTO;
use App\UseCases\Referral\GetMyReferrals\GetMyReferralsUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReferralController extends Controller
{
    /**
     * POST /api/referrals/attach — закрепить текущего мастера за владельцем кода.
     */
    public function attach(AttachReferralRequest $request, AttachReferralUseCase $useCase): JsonResponse
    {
        $referral = $useCase->handle(
            AttachReferralDTO::fromRequest($request, $this->currentMaster($request))
        );

        return (new ReferralResource($referral))
            ->additional(['created' => $referral->wasRecentlyCreated])
            ->response()
            ->setStatusCode($referral->wasRecentlyCreated ? 201 : 200);
    }

    /**
     * GET /api/referrals/my — список приведённых мной мастеров.
     */
    public function my(Request $request, GetMyReferralsUseCase $useCase): AnonymousResourceCollection
    {
        $referrals = $useCase->handle(new GetMyReferralsDTO($this->currentMaster($request)));

        return MyReferralResource::collection($referrals);
    }

    /**
     * GET /api/referrals/earnings — сводка по реферальным деньгам.
     */
    public function earnings(Request $request, GetEarningsSummaryUseCase $useCase): EarningsSummaryResource
    {
        $summary = $useCase->handle(new GetEarningsSummaryDTO($this->currentMaster($request)));

        return new EarningsSummaryResource($summary);
    }

    /**
     * Текущий мастер из заголовка X-Master-Id (разложен middleware ResolveCurrentMaster).
     */
    private function currentMaster(Request $request): Master
    {
        return $request->attributes->get('current_master')
            ?? abort(401, 'Header X-Master-Id is required.');
    }
}
