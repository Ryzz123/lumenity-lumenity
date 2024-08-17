<?php

namespace Lumenity\Framework\config\common\app;

use Illuminate\Support\Collection;

/**
 * Class PaginationResult
 *
 * This class is used to encapsulate the result of a paginated query.
 * It contains the data from the query and the pagination information.
 *
 * @package Lumenity\Framework\config\common\app
 */
class paginationresult
{
    /**
     * @var Collection The data from the paginated query.
     */
    public Collection $data;

    /**
     * @var array The pagination information. This typically includes the current page, total pages, total items, etc.
     */
    public array $pagination;

    /**
     * PaginationResult constructor.
     *
     * This constructor initializes the PaginationResult object with the data from the paginated query and the pagination information.
     *
     * @param Collection $data The data from the paginated query.
     * @param array $pagination The pagination information.
     */
    public function __construct(Collection $data, array $pagination)
    {
        $this->data = $data;
        $this->pagination = $pagination;
    }
}