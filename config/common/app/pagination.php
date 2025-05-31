<?php

namespace Lumenity\Framework\config\common\app;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Pagination Class
 *
 * This class provides pagination functionality for an array of data.
 * It allows you to paginate through the data set by specifying the page and limit.
 */
class pagination
{
    private Model|Builder $query;
    private int $page;
    private int $limit;

    public function __construct(int $limit, int $page, Model|Builder $query)
    {
        $this->limit = $limit;
        $this->page = $page;
        $this->query = $query;
    }

    /**
     * Create Collection
     *
     * Creates a new collection instance from the given data.
     *
     * @param array $data The data to be converted into a collection
     * @return Collection The collection instance containing the data
     */
    public static function collection(array $data): Collection
    {
        return new Collection($data);
    }

    /**
     * Set Limit
     *
     * Sets the limit for pagination.
     *
     * @return Collection
     */
    public function paginate(): Collection
    {
        $current_page = max(1, $this->page);
        if ($this->query instanceof Model) {
            $query = $this->query->newQuery();
        } else {
            $query = $this->query;
        }

        $total = $query->count();
        $total_page = (int)ceil($total / $this->limit);

        $data = $query->orderBy('created_at', 'desc')
            ->skip(($current_page - 1) * $this->limit)
            ->take($this->limit)
            ->get();

        $prevPages = [];
        if ($current_page > 1) {
            for ($i = max(1, $current_page - 2); $i < $current_page; $i++) {
                $prevPages[] = $i;
            }
        }

        $nextPages = [];
        if ($current_page < $total_page) {
            for ($i = $current_page + 1; $i <= min($total_page, $current_page + 2); $i++) {
                $nextPages[] = $i;
            }
        }

        $pagination = [
            'page' => $current_page,
            'total' => $total,
            'total_pages' => $total_page,
            'limit' => $this->limit,
            'prev' => $prevPages,
            'next' => $nextPages,
        ];

        return self::collection([
            'data' => $data,
            'pagination' => $pagination,
        ]);
    }
}