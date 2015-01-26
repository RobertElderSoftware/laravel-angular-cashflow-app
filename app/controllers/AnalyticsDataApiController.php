<?php
 
class AnalyticsDataApiController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    private function get_cashflow_events($cashflow_category_id){
        $query = DB::table('cashflow_events')
            ->join('users', 'cashflow_events.owner_id', '=', 'users.id')
            ->select('cashflow_events.amount', 'cashflow_events.memo', 'cashflow_events.cashflow_category_id', DB::raw('date_format(cashflow_events.event_time , \'%Y-%m-%d\') as event_time'), 'users.firstname', 'users.lastname', 'cashflow_events.owner_id', 'cashflow_events.id');
        if(!($cashflow_category_id === false)){
            $query = $query->where('cashflow_events.cashflow_category_id', '=', $cashflow_category_id);
        }
	$query = $query->orderBy('cashflow_events.event_time', 'desc');
        return $query->get();
    }

    public function index() {
        $cashflow_category_id = Input::get('cashflow_category_id');
        if(is_numeric($cashflow_category_id)){
            return Response::json($this->get_cashflow_events($cashflow_category_id), 200, [], JSON_NUMERIC_CHECK);
        }else{
            return Response::json($this->get_cashflow_events(false), 200, [], JSON_NUMERIC_CHECK);
        }
    }
}
?>
