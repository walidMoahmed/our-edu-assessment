<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReadJsonFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private function getParentIdentification($transactions, $parentEmail){

        for ($counter = 0, $countMax = count($transactions); $counter < $countMax; $counter++ ){
            if ($transactions[$counter]['parentEmail'] == $parentEmail){
                return $transactions[$counter]['parentIdentification'];
            }
        }
        return null;
    }

    private function reformateDate($date){
        $time = strtotime($date);
        return date('Y-m-d',$time);
    }

    public function run()
    {
        $transactions = json_decode(file_get_contents(public_path() . "/transactions.json"), true, 512, JSON_THROW_ON_ERROR);
        $transactions = $transactions['transactions'];

        $users = json_decode(file_get_contents(public_path() . "/users.json"), true, 512, JSON_THROW_ON_ERROR);
        $users = $users['users'];

        for ($counter = 0, $countMax = count($users); $counter < $countMax; $counter++ ){

            $currency_id = Currency::where('name',$users[$counter]['currency'])->pluck('id')->first();
            $identification = $this->getParentIdentification($transactions, $users[$counter]['email']);
            $date = $this->reformateDate($users[$counter]['created_at']);
            Customer::create([
                'balance' => $users[$counter]['balance'],
                'currency_id' => $currency_id,
                'email' => $users[$counter]['email'],
                'created_at' => $date,
                'code' => $users[$counter]['id'],
                'identification' =>$identification,
            ]);
        }

        for ($counter = 0, $countMax = count($transactions); $counter < $countMax; $counter++ ){

            $customer_id = Customer::where('email',$transactions[$counter]['parentEmail'])->pluck('id')->first();
            $date = $this->reformateDate($transactions[$counter]['paymentDate']);

            Transaction::create([
                'customer_id' => $customer_id,
                'status_id' => $transactions[$counter]['statusCode'],
                'paid_amount' => $transactions[$counter]['paidAmount'],
                'payment_date' => $date,

            ]);
        }
    }
}
