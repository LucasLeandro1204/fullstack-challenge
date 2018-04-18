<?php

namespace App\Queries;

use App\Advertisement;
use App\Core\QueryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;

class SearchAdvertisements implements QueryInterface
{
    public function __construct(string $query = null, string $orderBy = 'desc')
    {
        $this->query = $query;
        $this->orderBy = $orderBy;
    }

    public function get(int $perPage = 15): Paginator
    {
        return Advertisement::orderBy('id', $this->orderBy)
            ->when($this->query, function ($builder) {
                $builder->where('title', 'LIKE', "%$this->query%");
            })
            ->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
    public static function from(Request $request): QueryInterface
    {
        $request->validate([
            'order_by' => 'string|in:asc,desc',
            'search' => 'string|max:255|nullable',
        ]);

        return new self(
            $request->input('search'),
            $request->input('order_by', 'desc')
        );
    }
}
