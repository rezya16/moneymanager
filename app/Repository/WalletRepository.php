<?php


namespace App\Repository;


use App\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WalletRepository implements WalletRepositoryInterface
{
    private $model;
    private $userID;

    public function __construct()
    {
        $this->model = app(Wallet::class);
        $this->userID = Auth::id();
    }

    private function toDbArray(array $apiResponse): array
    {
        return [
            'value' => $apiResponse['value'],
            'type' => $apiResponse['type'],
            'source'=> $apiResponse['source'],
            'date' => $apiResponse['date'],
            'user_id' => $apiResponse['user_id']
        ];
    }
    public function addMoney(array $data): array
    {
        $data = $this->toDbArray($data);
        $this->model->create($data);
        return $data;
    }

    public function findMoneybyId()
    {
        $wallet = $this->model
            ->where('user_id', $this->userID)
            ->get();
        return $wallet;
    }

    public function findMoneybyType(string $type)
    {
        $wallet = $this->model
            ->where('user_id',$this->userID)
            ->where('type',"$type")
            ->get();
        return $wallet;
    }

        public function findMoneybyDates($from, $to)
    {
        $wallet = $this->model
            ->whereBetween('date',[$from,$to])
            ->where('user_id',$this->userID)
            ->orderBy('date')
            ->get();
        unset($wallet['id'],$wallet->user_id);
        return $wallet;
    }

    public function updateMoney(int $id,int $value,string $type,string $source,string $date)
    {
        $result = $this->model
            ->where('user_id',$this->userID)
            ->where('id',$id)
            ->update(['value' => $value, 'type'=>"$type", 'source' => "$source", 'date' => "$date"]);
        return $result;
    }

    public function deleteMoney(int $id)
    {

        $result = $this->model
            ->where('id', $id)
            ->delete();
        return [];
    }

}
