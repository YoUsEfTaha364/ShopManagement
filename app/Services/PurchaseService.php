<?php

namespace App\Services;

use App\Models\Purchase;

class PurchaseService
{
    /**
     * Get purchases with filters and pagination.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPurchases(array $filters = [], int $perPage = 10)
    {
        $query = Purchase::with(['items', 'supplier']);

        if (array_key_exists('has_remaining', $filters) && $filters['has_remaining']) {
            $query->where('remaining_amount', '>', 0);
        }

        if (array_key_exists('last_purchases', $filters) && $filters['last_purchases']) {
            $query->latest('date')->latest('id');
        } else {
            // Default ordering, maybe latest id anyway to show newest first?
            $query->latest('id');
        }

        return $query->paginate($perPage);
    }
}
