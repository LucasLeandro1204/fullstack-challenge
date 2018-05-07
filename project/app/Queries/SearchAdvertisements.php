<?php

namespace App\Queries;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;

class SearchAdvertisements
{
    /**
     * Query
     *
     * @var string
     */
    protected $query;

    /**
     * Category id
     *
     * @var integer
     */
    protected $category;

    /**
     * Sort field.
     *
     * @var string
     */
    protected $field;

    /**
     * Sort order.
     *
     * @var string
     */
    protected $sort;

    /**
     * Filters.
     *
     * @var array
     */
    protected $filters;

    /**
     * Create a new instance.
     */
    public function __construct(?string $query, ?integer $category, string $field, string $sort, array $filters)
    {
        $this->query = $query;
        $this->category = $category;
        $this->field = $field;
        $this->sort = $sort;
        $this->filters = $filters;
    }

    /**
     * Get the advertisements filtered and paginated.
     */
    public function get(int $perPage = 15): Paginator
    {
        return Advertisement::orderBy($this->field, $this->sort)
            ->when($this->query, function (Builder $builder) {
                $builder->where('title', 'LIKE', "%$this->query%");
            })
            ->when($this->category, function (Builder $builder) {
                $builder->whereHas('category', function (Builder $builder) {
                    $builder->where('id', $this->category);
                });
            })
            ->when($this->filters, function (Builder $builder) {
                $builder->whereHas('values', function (Builder $builder) {
                    foreach ($this->filters as $key => $value) {
                        $builder->where(function (Builder $builder) use ($key, $value) {
                            $builder->where('field_id', $key);

                            if (isset($value['from']) || $value['to']) {
                                $builder->where('value', '>', $value['from'] ?? 0)
                                    ->when(isset($value['to']), function (Builder $builder) use ($value) {
                                        $builder->where('value', '<', $value['to']);
                                    });
                            } else {
                                $builder->whereIn('value', $value);
                            }
                        });
                    }
                });
            })->paginate($perPage);

    }

    /**
     * Create a new query instance from request.
     */
    public static function from(Request $request): self
    {
        $request->validate([
            'query' => 'string',
            'filters' => 'array',
            'filters.*' => 'array',
            'category' => 'integer',
            'filters.*.to' => 'integer',
            'filters.*.from' => 'integer',
            'order_by.field' => 'sometimes|required',
            'order_by.sort' => 'sometimes|required|string|in:asc,desc',
        ]);

        return new self(
            $request->get('query'),
            $request->get('category'),
            $request->get('order_by.field', 'id'),
            $request->input('order_by.sort', 'desc'),
            $request->input('filters', [])
        );
    }
}
