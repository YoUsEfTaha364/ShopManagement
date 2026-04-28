<?php

namespace App\Services;

use App\Models\Sale;

class SaleService
{
    /**
     * Get sales with filters and pagination.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getSales(array $filters = [], int $perPage = 5)
    {
        $query = Sale::with('items.product');

        if (array_key_exists('has_remaining', $filters) && $filters['has_remaining']) {
            $query->where('remaining_price', '>', 0);
        }

        if (!empty($filters['customer_name'])) {
            $query->where('customer_name', 'like', '%' . $filters['customer_name'] . '%');
        }

        return $query->latest('id')->paginate($perPage);
    }
}
