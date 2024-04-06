<?php

namespace Lumenity\Framework\common\utils;

class pagination
{
    public array $data;
    public int $page;
    public int $limit;
    public int $total;

    public function __construct(array $data, int $page, int $limit)
    {
        $this->data = $data;
        $this->page = $page;
        $this->limit = $limit;
        $this->total = count($data);
    }

    public function paginate(): array
    {
        $totalPages = ceil($this->total / $this->limit);
        $offset = ($this->page - 1) * $this->limit;
        $data = array_slice($this->data, $offset, $this->limit);

        $prevPages = $this->calculatePrevPages();
        $nextPages = $this->calculateNextPages($totalPages);

        return [
            'data' => $data,
            'pagination' => [
                'page' => $this->page,
                'total' => $this->total,
                'total_pages' => (int)$totalPages,
                'limit' => $this->limit,
                'prev' => $prevPages,
                'next' => $nextPages,
            ],
        ];
    }

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