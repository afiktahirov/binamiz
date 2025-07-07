<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request) {

        $user = auth()->user();
        $query = auth()->user()
                ->profile
                ->transactions()
                ->with(["debt" => function($q){
                    return $q->with(['comunal' => fn($q) => $q->with(['building:id,name'])]);
                }]);


        if ($request->filled("search")) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where("property_type", "like", "%{$search}%")
                    ->orWhere("total_amount", "like", "%{$search}%")
                    ->orWhere("payed_amount", "like", "%{$search}%")
                    ->orWhere("building_name","like", "%{$search}%");
            });
        }

        // Sorting functionality
        $sortBy = $request->get("sort_by", "created_at");
        $sortDirection = $request->get("sort_direction", "desc");

        $allowedSorts = [
            "title",
            "type",
            "is_readed",
            "created_at",
        ];
        
        if (in_array($sortBy, $allowedSorts)) 
            $query->orderBy($sortBy, $sortDirection);
        else 
            $query->orderBy("created_at", "desc");
        

        // Pagination
        $perPage = $request->get("per_page", 10);
        $allowedPerPage = [10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        $transactions = $query->paginate($perPage);
        $transactions->appends($request->query());
        $transactions->withPath(request()->url());

        // Return JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                "html" => view(
                    "account.transactions.table",
                    compact("transactions")
                )->render(),
                "pagination" => [
                    "current_page" => $transactions->currentPage(),
                    "last_page" => $transactions->lastPage(),
                    "per_page" => $transactions->perPage(),
                    "total" => $transactions->total(),
                    "from" => $transactions->firstItem(),
                    "to" => $transactions->lastItem(),
                    "links" => $transactions
                        ->links("custom.pagination")
                        ->render(),
                ],
            ]);
        }

        // Prepare current state for JavaScript
        $currentState = [
            "search" => $request->get("search", ""),
            "sort_by" => $sortBy,
            "sort_direction" => $sortDirection,
            "per_page" => $perPage,
            "page" => $transactions->currentPage(),
        ];

        return view("account.transactions.index", [
                "transactions" => $transactions,
                "title" => "Ödənişlər",
                "currentState" => $currentState,
            ]);
    }

}
