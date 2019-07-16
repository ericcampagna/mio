<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Opportunity;
use App\Account;
use App\Contact;
use Forrest;
class DashboardController extends Controller
{
    public function show()
    {
    	$calls = $this->loggedCalls('list');
    	$recentCalls = array_slice($calls, 0, 5);
    	return view('sales')->with('recentCalls', $recentCalls);
    }

/**
 *
 * Data Compiling for Opportunities Chart on Sales Dashboard
 *
 */

    public function opportunitiesData($userId = null)
    {
    	if(!$userId) { $userId = '00541000003NqYgAAK'; }
    	
    	$user = User::find($userId);

    	//$opportunities = Opportunity::where('OwnerId', $user->id)->get();

    	$opportunities = Forrest::query("SELECT Amount, StageName FROM Opportunity WHERE OwnerId='".$userId."' AND FiscalYear=2019");

    	//return $opportunities['records'];

    	$closedWonDataArray = [];
    	$negotiationDataArray = [];
    	$proposalDataArray = [];
    	$qualificationDataArray = [];

    	
    	foreach($opportunities['records'] as $opportunity)
    	{

    		switch ($opportunity['StageName']) {
    			case 'Closed Won':
    				array_push($closedWonDataArray , $opportunity['Amount']);
    				break;
    			case 'Negotiation':
    				array_push($negotiationDataArray , $opportunity['Amount']);
    				break;
    			case 'Proposal':
    				array_push($proposalDataArray , $opportunity['Amount']);
    				break;
    			case 'Qualification':
    				array_push($qualificationDataArray , $opportunity['Amount']);
    				break;
    			default:
    				break;
    		}
  
    	}
    	$closedWonSum = array_sum($closedWonDataArray);
    	$negotiationSum = array_sum($negotiationDataArray);
    	$proposalSum = array_sum($proposalDataArray);
    	$qualificationSum = array_sum($qualificationDataArray);


    	$dataSets = [
    		[
    			'backgroundColor' => ['#7C070F','#A40E18','#CD1621','#F7202B'],
    			'data' => [$qualificationSum,$proposalSum,$negotiationSum,$closedWonSum]
    		],

    	];

    	$data = ['labels' => ['Qualification', 'Proposal','Negotiation','Closed Won'], 'datasets' => $dataSets];

    	return $data;
    }

    public function opportunitiesDataAll($userId = null)
    {
    	if(!$userId) { $userId = '00541000003NqYgAAK'; }
    	
    	$user = User::find($userId);

    	$opportunities = Opportunity::where('OwnerId', $user->id)->get();


    	return $opportunities;
    }


    public function loggedCalls($requestType)
    {
    	$userId = '00541000003NqYgAAK';
    	$cYear = date('Y');

    	$tasks = Forrest::query("SELECT Id,CreatedDate,Subject,WhoId,Description,TaskSubtype,Account.Name,Who.Type,Who.Name,Owner.Alias, TYPEOF What WHEN Opportunity THEN StageName WHEN Account THEN TYPE END FROM Task WHERE What.Type IN ('Acount', 'Opportunity') AND OwnerId='".$userId."' AND CALENDAR_YEAR(CreatedDate) = ".$cYear."  AND (TaskSubtype='Call' OR Subject LIKE 'Email:%') ORDER BY CreatedDate DESC");

    	//return $tasks;
    	$log = array();

    	$NegotiationCalls = array();
    	$AccountCalls = array();
    	$QualificationCalls = array();
    	$ProposalCalls = array();

    	foreach ($tasks['records'] as $task) {
    		switch ($task['What']['StageName']) {
    			case 'Closed Won':
    				$type = 'exsiting';
    				$AccountCalls[] = $task['Id']; 
    				break;
    			case 'Proposal':
    				$type = 'proposal';
    				$ProposalCalls[] = $task['Id'];
    				break;	
    			case 'Negotiation':
    				$type = 'negotiation';
    				$NegotiationCalls[] = $task['Id'];
    				break;
    			case 'Qualification':
    				$type = 'qualification';
    				$QualificationCalls[] = $task['Id'];
    				break;	
    		}

    		$log[] = array(
    			'Id' => $task['Id'],
    			'Type' => $type,
    			'CreatedDate' => $task['CreatedDate'],
    			'Company' => $task['Account']['Name'],
    			'Description' => $task['Description'],
    			'Contact' => $task['Who']['Name'],
    			'FormatedDate' => date("F jS", strtotime($task['CreatedDate'])),
    			'TaskType' => $task['TaskSubtype'],
    		);

    		
    	}

    	// $logSorted = $this->array_orderby($log, 'CreatedDate', SORT_DESC);

    	// foreach($logSorted as &$l)
    	// {
    	// 	$l['FormatedDate'] = date("F jS", strtotime($l['CreatedDate']));
    		
    	// }

    	if($requestType == 'chart'){


	    	$dataSets = [
	    		[
	    			'backgroundColor' => ['#04344E','#255A7C','#4D82AA','#7BACD4','#AFD7FB'],
	    			'data' => [count($NegotiationCalls),count($AccountCalls), count($ProposalCalls),count($QualificationCalls)]
	    		],

	    	];

	    	$data = ['labels' => ['Negotiation Calls', 'Exsiting Account Calls', 'Proposal Calls', 'Qualification Calls'], 'datasets' => $dataSets];

	    	return $data;

    	}

    	return $log;
    }


    function array_orderby()
	{
	    $args = func_get_args();
	    $data = array_shift($args);
	    foreach ($args as $n => $field) {
	        if (is_string($field)) {
	            $tmp = array();
	            foreach ($data as $key => $row)
	                $tmp[$key] = $row[$field];
	            $args[$n] = $tmp;
	            }
	    }
	    $args[] = &$data;
	    call_user_func_array('array_multisort', $args);
	    return array_pop($args);
	}

	function formatDate($date, $format)
	{
		$date = DateTime::createFromFormat('Y-m-d', '2009-08-12');
		$output = $date->format('F j, Y');
	}
}
