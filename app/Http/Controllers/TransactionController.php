<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\TransactionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index(Request $request)
    {
        $transactions = $this->transactionRepository->getTransaction($request);
        $transactionCancel = $this->transactionRepository->getTransactionCancel($request);
        $transactionsExpired = $this->transactionRepository->getTransactionExpired($request);
        return view('transaction.index', compact('transactions', 'transactionCancel', 'transactionsExpired'));
    }
}
