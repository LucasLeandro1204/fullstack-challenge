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
            'id', 'desc',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    protected $rules = [
        'category' => 'integer',
        'range.*.0' => 'integer',
        'range.*.1' => 'integer',
        'check_box.*' => 'array',
        'search' => 'string|nullable',
        'order_by.0' => 'sometimes|required',
        'order_by.1' => 'sometimes|required|string|in:asc,desc',
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
     * Custom field check box filter.
     */
    public function checkBox(array $options): self
    {
        foreach ($options as $key => $value) {
            $this->whereHas('values', function (Builder $builder) use ($key, $value) {
                $builder->where('field_id', $key)
                    ->whereIn('value', $value);
            });
        }

        return $this;
    }

    /**
     * Custom field range filter.
     */
    public function range(array $ranges): self
    {
        foreach ($ranges as $key => $value) {
            $this->whereHas('values', function (Builder $builder) use ($key, $value) {
                $builder->where('field_id', $key)
                    ->where('value', '>', $value[0] ?? 0)
                    ->when(isset($value[1]), function (Builder $builder) use ($value) {
                        $builder->where('value', '<', $value[1]);
                    });
            });
        }

        return $this;
    }

    /**
     * Filter by title or description.
     */
    public function search(?string $keyword): self
    {
        $this->model->where(function (Builder $builder) use ($keyword) {
            $builder->where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%");
        });

        return $this;
    }
}
