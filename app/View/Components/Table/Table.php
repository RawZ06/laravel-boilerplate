<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Table extends Component
{
    public Collection $rows;
    public bool $isPaginated;
    public mixed $paginator;
    public array $columns;
    public string $currentSort;
    public string $currentDir;

    public function __construct(
        mixed         $rows,
        array         $columns      = [],
        public bool   $striped      = false,
        public string $id           = 'table',
        public ?string $emptyMessage = 'Aucun résultat.',
    ) {
        $this->isPaginated = $rows instanceof LengthAwarePaginator;
        $this->paginator   = $this->isPaginated ? $rows : null;
        $this->rows        = $this->isPaginated ? collect($rows->items()) : collect($rows);

        // Tri préfixé par id pour éviter la synchro entre tableaux
        $this->currentSort = request("{$id}_sort", '');
        $this->currentDir  = request("{$id}_dir", 'asc');

        $this->columns = $this->resolveColumns($columns);
    }

    protected function resolveColumns(array $columns): array
    {
        if (!empty($columns)) {
            return array_map(fn($col) => array_merge([
                'key'        => '',
                'label'      => '',
                'sortable'   => false,
                'searchable' => false,
            ], $col), $columns);
        }

        $first = $this->rows->first();
        if (!$first) return [];

        $keys = is_array($first) ? array_keys($first) : array_keys($first->getAttributes());

        return array_map(fn($key) => [
            'key'        => $key,
            'label'      => ucfirst(str_replace('_', ' ', $key)),
            'sortable'   => false,
            'searchable' => false,
        ], $keys);
    }

    public function sortUrl(string $key): string
    {
        $dir = ($this->currentSort === $key && $this->currentDir === 'asc') ? 'desc' : 'asc';

        return request()->fullUrlWithQuery([
            "{$this->id}_sort" => $key,
            "{$this->id}_dir"  => $dir,
            'page'             => 1,
        ]);
    }

    public function render(): View|Closure|string
    {
        return view('components.table.table');
    }
}
