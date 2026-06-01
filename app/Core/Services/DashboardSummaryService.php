<?php

namespace App\Core\Services;

use App\Modules\InternalRequests\Services\InternalRequestsService;
use App\Modules\LeaveRequests\Services\LeaveRequestsService;

use Codeigniter\Config\BaseService;

class DashboardSummaryService extends BaseService
{
	
	private InternalRequestsService $irService;

	private LeaveRequestsService $lrService;

	public function getSummary(): string
	{
		$allInternalRequests = $this->irService->getAllRequests();

		$managedRequests = $this->irService->getManagedRequests();

		$totalNumberOfRequests = count($allInternalRequests);

		$numberOfManagedRequests = count($managedRequests);

		return "Out of $totalNumberOfRequests, $numberOfManagedRequests were handled";
	}

	public function __construct()
	{
		$this->irService = new InternalRequestsService();

		$this->lrService = new LeaveRequestsService();
	}
}
