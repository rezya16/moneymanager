<?php

namespace App\Http\Controllers;

use App\Repository\WalletRepository;
use App\Repository\WalletRepositoryInterface;
use App\Wallet;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class WalletController extends Controller
{
    private $walletRepository;
    private $userID;

    public function __construct(WalletRepositoryInterface $walletRepository)
    {
        $this->walletRepository = $walletRepository;
        $this->middleware('jwt.auth');
        $this->userID = Auth::id();
    }

    public function add(Request $request)
    {
        if ((Auth::check()))
        {
            if (empty($request->value)||empty($request->type)||empty($request->date)){
                return \response()->json(['mesage' =>'Error : invalid data'],Response::HTTP_BAD_REQUEST);
            }
            $data = [
                'value' => $request->value,
                'type' => $request->type,
                'source' => $request->source,
                'date' => $request->date,
                'user_id' => $this->userID
            ];


            $result = $this->walletRepository->addMoney($data);
            unset($result['user_id']);
            if (!isset($result)){
                return response()->json(['message' => 'Error : ivalid data'],Response::HTTP_BAD_REQUEST);
            }

            return response()->json($result,Response::HTTP_CREATED);
        }
    }

    public function show(Request $request)
    {
        if (Auth::check())
        {
            $wallet = $this->walletRepository->findMoneybyId();
            foreach ($wallet as $value)
            {
                unset($value['user_id']);
            }
            return response()->json($wallet,Response::HTTP_OK);
        }
    }

    public function findByType(Request $request)
    {
        if (Auth::check())
        {
            if ($request->type == 'income' || $request->type == 'outcome'){
                $wallet = $this->walletRepository->findMoneybyType($request->type);
                if (isset($wallet)) {
                    foreach ($wallet as $value)
                    {
                        unset($value['user_id']);
                    }
                    return response()->json($wallet, Response::HTTP_OK);
                }
                else {
                    return response()->json(null,Response::HTTP_NOT_FOUND);
                }
            } else {
                return response()->json(['message' => 'error:Invalid type'], Response::HTTP_BAD_REQUEST);
            }
        }
    }

    public function findByDates (Request $request)
    {
        if (Auth::check())
        {
            $from = $request->from;
            $to = $request->to;
            $wallet = $this->walletRepository->findMoneybyDates($from,$to);
            foreach ($wallet as $value)
            {
                unset($value['user_id']);
            }
            return response()->json($wallet,Response::HTTP_OK);
        }
    }

    public function update (Request $request)
    {
        if (Auth::check())
        {
            $wallet = $this->walletRepository->updateMoney(
                $request->id,
                $request->value,
                $request->type,
                $request->source,
                $request->date);
            return \response()->json($wallet,Response::HTTP_OK);
        }
    }

    public function delete(Request $request)
    {
        if (Auth::check())
        {
            $wallet = $this->walletRepository->deleteMoney($request->id);
            return \response()->json(['message' => 'Record deleted'],Response::HTTP_NO_CONTENT);
        }
    }
}
