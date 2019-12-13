<?php


namespace App\Repository;


use App\Wallet;

interface WalletRepositoryInterface
{
    /**
     * Добавляет Операцию доход/расход в БД
     * @param array $data
     * @return array
     */
    public function addMoney (array $data): array;

    /**
     * @return Wallet|null
     */
    public function findMoneybyId ();

    /**
     * @param string $type
     * @return mixed
     */
    public function findMoneybyType (string $type);

    public function findMoneybyDates ($from,$to);

    /**
     * @param int $id
     * @param int $value
     * @param string $type
     * @param string $source
     * @param string $date
     * @return mixed
     */
    public function updateMoney(int $id,int $value,string $type,string $source,string $date);

    public function deleteMoney(int $id);
}
