<?php

namespace App\Controllers;

use App\Core\Services\SummaryService;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Override;

class SummaryController extends BaseController
{
    private SummaryService $service;

    #[Override]
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->service = new SummaryService();
    }

    /**
     * Display summary page
     */
    public function index(): string
    {
        return view('summary');
    }

    /**
     * Get summary data (JSON API)
     */
    public function data(): ResponseInterface
    {
        try {
            $stats = $this->service->getStatistics();
            $recent = $this->service->getRecentRequests(10);

            return $this->response->setJSON([
                'success' => true,
                'stats' => $stats,
                'recent_requests' => $recent,
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            log_message('error', 'Failed to load summary data: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to load summary data',
            ])->setStatusCode(500);
        }
    }
}
