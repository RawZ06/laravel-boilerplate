<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Filterable
{
    public function scopeFilter(Builder $query, array $filters, ?string $tableIdPrefix = null): Builder
    {
        $this->applyColumnFilters($query, $filters, $tableIdPrefix);
        $this->applyGlobalSearch($query, $filters);
        $this->applySelectFilters($query, $filters);

        return $query;
    }

    private function applyColumnFilters(Builder $query, array $filters, ?string $tableIdPrefix): void
    {
        $prefix = $tableIdPrefix ? "{$tableIdPrefix}_search_" : 'search_';

        foreach ($filters as $key => $value) {
            if (empty($value) || ! Str::startsWith($key, $prefix)) {
                continue;
            }

            $column = Str::after($key, $prefix);

            $this->isExactColumn($column)
                ? $query->where($column, $value)
                : $query->whereRaw("LOWER({$column}) LIKE ?", ['%'.strtolower($value).'%']);
        }
    }

    private function applyGlobalSearch(Builder $query, array $filters): void
    {
        $searchKey = $filters['_search_key'] ?? 'q';

        if (empty($filters[$searchKey])) {
            return;
        }

        $searchable = property_exists($this, 'searchable')
            ? $this->searchable
            : ['name', 'email'];

        $query->where(function (Builder $q) use ($filters, $searchKey, $searchable) {
            foreach ($searchable as $column) {
                $q->orWhereRaw("LOWER({$column}) LIKE ?", ['%'.strtolower($filters[$searchKey]).'%']);
            }
        });
    }

    private function applySelectFilters(Builder $query, array $filters): void
    {
        if (empty($filters['filter']) || ! is_array($filters['filter'])) {
            return;
        }

        foreach ($filters['filter'] as $column => $value) {
            if (empty($value)) {
                continue;
            }

            $this->isExactColumn($column)
                ? $query->where($column, $value)
                : $query->whereRaw("LOWER({$column}) LIKE ?", ['%'.strtolower($value).'%']);
        }
    }

    private function isExactColumn(string $column): bool
    {
        if (property_exists($this, 'exactFilters')) {
            return in_array($column, $this->exactFilters);
        }

        $casts = method_exists($this, 'getCasts') ? $this->getCasts() : [];

        return isset($casts[$column]);
    }
}
