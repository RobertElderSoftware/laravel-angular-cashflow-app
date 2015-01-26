<?php
 
class CashflowCategoriesApiController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
  	$this->beforeFilter('csrf_json', array('on'=>'post'));
    }

    private function get_cashflow_categories($id){
        $query = DB::table('cashflow_categories')
            ->select('cashflow_categories.cashflow_category', 'cashflow_categories.id');

        if(!($id === false)){
            $query = $query->where('cashflow_categories.id', '=', $id);
        }
        return $query->get();
    }

    public function index() {
        return Response::json($this->get_cashflow_categories(false));
    }
}
?>
