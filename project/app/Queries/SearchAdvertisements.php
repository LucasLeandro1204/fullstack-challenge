<?php

namespace App\Queries;

use App\Core\Query;
use App\Advertisement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;

class SearchAdvertisements extends Query
{
    /**
     * {@inheritdoc}
     */
    protected $defaults = [
        'order_by' => [
            'field' => 'id',
            'sort' => 'desc',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    protected $rules = [
        'search' => 'string',
        'filters' => 'array',
        'filters.*' => 'array',
        'category' => 'integer',
        'filters.*.to' => 'integer',
        'filters.*.from' => 'integer',
        'order_by.field' => 'sometimes|required',
        'order_by.sort' => 'sometimes|required|string|in:asc,desc',
    ];

    /**
     * Create a new instance.
     */
    public function __construct(Advertisement $model)
    {
        $this->model = $model;
    }

    /**
     * Get paginated.
     */
    public function get(int $perPage = 15): Paginator
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Order by method proxy.
     */
    protected function orderBy(array $config): self
    {
        $this->model->orderBy($config['field'], $config['sort']);

        return $this;
    }

    /**
     * Filter by category.
     */
    public function category(int $id): self
    {
        $this->model->whereHas('category', function (Builder $builder) use ($id) {
            $builder->where('id', $id);
        });

        return $this;
    }

    /**
     * Custom fields filter.
     */
    public function filters(array $filters): self
    {
        foreach ($filters as $key => $value) {
            $builder->whereHas('values', function (Builder $builder) use ($key, $value) {
                $builder->where('field_id', $key);

                if (isset($value['from']) || isset($value['to'])) {
                    $builder->where('value', '>', $value['from'] ?? 0)
                        ->when(isset($value['to']), function (Builder $builder) use ($value) {
                            $builder->where('value', '<', $value['to']);
                        });
                } else {
                    $builder->whereIn('value', $value);
                }
            });
        }

        return $this;
    }

    /**
     * Filter by title or description.
     */
    public function search(string $keyword): self
    {
        $this->model->where(function (Builder $builder) use ($keyword) {
            $builder->where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%");
        });

        return $this;
    }
}
