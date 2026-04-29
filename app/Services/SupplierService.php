<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SupplierService
{
    /**
     * Get suppliers departments/debts history with filters and pagination.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getSuppliersDebts(array $filters = [], int $perPage = 10)
    {
        $query = DB::table('suppliers')
            ->join("purchases", 'suppliers.id', '=', 'purchases.supplier_id')
            ->select(
                'suppliers.id as supplier_id',
                'suppliers.name',
                DB::raw('SUM(total_amount) as total'),
                DB::raw('SUM(paid_amount) as paid'),
                DB::raw('SUM(remaining_amount) as remaining')
            )
            ->groupBy('suppliers.id', 'suppliers.name');

        if (!empty($filters['name'])) {
            $query->where('suppliers.name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['debt_status'])) {
            if ($filters['debt_status'] === 'has_debt') {
                $query->havingRaw('SUM(remaining_amount) > 0');
            } elseif ($filters['debt_status'] === 'no_debt') {
                $query->havingRaw('SUM(remaining_amount) = 0'); // or maybe <= 0 just in case
            }
        }

        return $query->paginate($perPage);
    }
}
