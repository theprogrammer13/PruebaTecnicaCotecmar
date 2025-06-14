<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function reports(): Response
    {
        $projectsWithPendingParts = $this->reportService->getPendingPartsReport();
        $projectsStatusData = $this->reportService->getProjectStatusReport();
        
        return Inertia::render('Reports/Index', [
            'pendingParts' => $projectsWithPendingParts,
            'statusData' => $projectsStatusData
        ]);
    }
}