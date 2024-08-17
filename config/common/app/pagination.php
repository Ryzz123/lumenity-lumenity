<?php

namespace Lumenity\Framework\config\common\app;

use Illuminate\Support\Collection;

/**
 * Pagination Class
 *
 * This class provides pagination functionality for an array of data.
 * It allows you to paginate through the data set by specifying the page and limit.
 */
class pagination
{
    private array $data;
    private int $page;
    private int $limit;
    private int $total;

    /**
     * Constructor
     *
     * Initializes the pagination object with the provided data array.
     *
     * @param array $data The array of data to be paginated
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->total = count($data);
        $this->page = 1;
        $this->limit = 10; // Default limit is 10 items per page
    }

    /**
     * Set Limit
     *
     * Sets the limit of items per page.
     *
     * @param int $limit The limit of items per page
     * @return Pagination The Pagination object for method chaining
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Set Page
     *
     * Sets the current page.
     *
     * @param int $page The current page
     * @return Pagination The Pagination object for method chaining
     */
    public function page(int $page): self
    {
        $this->page = $page;
        return $this;
    }

    /**
     * Paginate Data
     *
     * Paginates the data array based on the current page and limit.
     *
     * @return paginationresult An Pagination Class containing the paginated data and pagination information
     */
    public function paginate(): paginationresult
    {
        $totalPages = ceil($this->total / $this->limit);
        $offset = ($this->page - 1) * $this->limit;
        $collection = new Collection($this->data);
        $collection = $collection->slice($offset, $this->limit);

        $prevPages = $this->calculatePrevPages();
        $nextPages = $this->calculateNextPages($totalPages);

        return self::Result($collection, [
            'page' => $this->page,
            'total' => $this->total,
            'total_pages' => (int)$totalPages,
            'limit' => $this->limit,
            'prev' => $prevPages,
            'next' => $nextPages,
        ]);
    }

    private static function Result(Collection $collection, array $pagination): paginationresult
    {
        return new paginationresult($collection, $pagination);
    }

    /**
     * Calculate Previous Pages
     *
     * Calculates the previous page numbers.
     *
     * @return array|null An array containing the previous page numbers, or null if no previous pages
     */
    private function calculatePrevPages(): ?array
    {
        if ($this->page <= 1) {
            return null;
        }

        $prevPages = [];
        $prevPage = $this->page - 1;

        if ($prevPage > 1) {
            $prevPages[] = $prevPage - 1;
        }

        $prevPages[] = $prevPage;

        return $prevPages;
    }

    /**
     * Calculate Next Pages
     *
     * Calculates the next page numbers.
     *
     * @param int $totalPages The total number of pages
     * @return array|null An array containing the next page numbers, or null if no next pages
     */
    private function calculateNextPages(int $totalPages): ?array
    {
        if ($this->page >= $totalPages) {
            return null;
        }

        $nextPages = [];
        $nextPage = $this->page + 1;

        $nextPages[] = $nextPage;

        if ($nextPage < $totalPages) {
            $nextPages[] = $nextPage + 1;
        }

        return $nextPages;
    }
}