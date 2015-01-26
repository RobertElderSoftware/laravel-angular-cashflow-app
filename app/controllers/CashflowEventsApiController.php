<?php
 
class CashflowEventsApiController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
  	$this->beforeFilter('csrf_json', array('on'=>'post'));
    }


    private function get_cashflow_events($id){
        $query = DB::table('cashflow_events')
            ->join('users', 'cashflow_events.owner_id', '=', 'users.id')
            ->select('cashflow_events.amount', 'cashflow_events.memo', 'cashflow_events.cashflow_category_id', DB::raw('date_format(cashflow_events.event_time , \'%Y-%m-%d\') as event_time'), 'users.firstname', 'users.lastname', 'cashflow_events.owner_id', 'cashflow_events.id');
        if(!($id === false)){
            $query = $query->where('cashflow_events.id', '=', $id);
        }
        return $query->get();
    }

    public function index() {
        return Response::json($this->get_cashflow_events(false));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $rules = array(
            'amount'       => 'required|numeric',
            'memo'      => 'required',
            'event_time'      => 'required',
            'cashflow_category_id'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
		return Response::json($validator->messages(), 400);
        } else {
		$cashflow_event = new CashflowEvent;
		$cashflow_event->amount= Input::get('amount');
		$cashflow_event->memo = Input::get('memo');
                $cashflow_event->event_time = Input::get('event_time');
                $cashflow_event->cashflow_category_id = Input::get('cashflow_category_id');
                $cashflow_event->owner_id = Auth::id();
		$cashflow_event->save();
        	return Response::json(array('success' => true));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
	return Response::json($this->get_cashflow_events($id)[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
	return Response::json(get_cashflow_events($id)[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $rules = array(
            'amount'       => 'required|numeric',
            'memo'      => 'required',
            'event_time'      => 'required',
            'cashflow_category_id'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(array('success' => false));
        } else {
            $cashflow_event = CashflowEvent::find($id);
            $cashflow_event->amount = Input::get('amount');
            $cashflow_event->event_time = Input::get('event_time');
            $cashflow_event->memo = Input::get('memo');
            $cashflow_event->cashflow_category_id = Input::get('cashflow_category_id');
            $cashflow_event->save();
            return Response::json(array('success' => true));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        CashflowEvent::destroy($id);
        return Response::json(array('success' => true));
    }
}
?>
