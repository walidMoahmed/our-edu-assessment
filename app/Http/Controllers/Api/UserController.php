<?php

    namespace App\Http\Controllers\Api;


    use App\Http\Controllers\Controller;
    use App\Http\Requests\FilterAmountRangeRequest;
    use App\Http\Requests\FilterCurrencyRequest;
    use App\Http\Requests\FilterDateRangeRequest;
    use App\Http\Requests\FilterTransactionRequest;
    use App\Models\Customer;
    use App\Traits\GeneralTrait;
    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        use GeneralTrait;

        public function index()
        {
            $customers = Customer::with('currency','transactions','transactions.status')->get();
            return $this->returnDate('data',$customers,"Customers data");
        }

        public function filter_status(FilterTransactionRequest $request){

            $customers= Customer::select('customers.id','customers.email','customers.code','customers.identification'
                ,'customers.balance', 'statuses.name','currencies.name','transactions.paid_amount','transactions.payment_date')
                ->join('transactions', 'customers.id', '=', 'transactions.customer_id')
                ->join('currencies', 'currencies.id', '=', 'customers.currency_id')
                ->join('statuses', 'statuses.id', '=', 'transactions.status_id')
                ->where('statuses.name','like',"%{$request->name}%")
                ->get();

            return $this->returnDate('data', $customers,"Customers data");
        }

        public function filter_currency(FilterCurrencyRequest $request){

            $customers= Customer::select('customers.id','customers.email','customers.code','customers.identification'
                ,'customers.balance', 'statuses.name','currencies.name','transactions.paid_amount','transactions.payment_date')
                ->join('transactions', 'customers.id', '=', 'transactions.customer_id')
                ->join('currencies', 'currencies.id', '=', 'customers.currency_id')
                ->join('statuses', 'statuses.id', '=', 'transactions.status_id')
                ->where('currencies.name','like',"%{$request->name}%")
                ->get();

            return $this->returnDate('data', $customers,"Customers data");
        }

        public function filter_amount_range(FilterAmountRangeRequest $request){

            $customers= Customer::select('customers.id','customers.email','customers.code','customers.identification'
                ,'customers.balance', 'statuses.name','currencies.name','transactions.paid_amount','transactions.payment_date')
                ->join('transactions', 'customers.id', '=', 'transactions.customer_id')
                ->join('currencies', 'currencies.id', '=', 'customers.currency_id')
                ->join('statuses', 'statuses.id', '=', 'transactions.status_id')
                ->whereBetween('transactions.paid_amount', [$request->from, $request->to])
                ->get();

            return $this->returnDate('data', $customers,"Customers data");
        }

        public function filter_date_range(FilterDateRangeRequest $request){

            $customers= Customer::select('customers.id','customers.email','customers.code','customers.identification'
                ,'customers.balance', 'statuses.name','currencies.name','transactions.paid_amount','transactions.payment_date')
                ->join('transactions', 'customers.id', '=', 'transactions.customer_id')
                ->join('currencies', 'currencies.id', '=', 'customers.currency_id')
                ->join('statuses', 'statuses.id', '=', 'transactions.status_id')
                ->whereBetween('transactions.payment_date', [$request->from, $request->to])
                ->get();

            return $this->returnDate('data', $customers,"Customers data");
        }


    }



