<?php

namespace App\Services;

use App\Models\Ecole;
use Illuminate\Database\Eloquent\Builder;

class EcoleQueryBuilder
{
    /**
     * @param  array<string, mixed>  $filters
     */
    public function build(array $filters): Builder
    {
        $query = Ecole::query()->with(['domaines', 'filieres']);

        if (! empty($filters['search'])) {
            $search = mb_strtolower((string) $filters['search']);
            $query->where(function (Builder $builder) use ($search): void {
                $like = "%{$search}%";
                $builder->whereRaw('LOWER(nom) LIKE ?', [$like])
                    ->orWhereRaw('LOWER(ville) LIKE ?', [$like])
                    ->orWhereHas('domaines', fn (Builder $relation) => $relation->whereRaw('LOWER(nom) LIKE ?', [$like]))
                    ->orWhereHas('filieres', fn (Builder $relation) => $relation->whereRaw('LOWER(nom) LIKE ?', [$like]));
            });
        }

        if (! empty($filters['ville'])) {
            $query->whereRaw('LOWER(ville) = ?', [mb_strtolower((string) $filters['ville'])]);
        }

        if (! empty($filters['type'])) {
            $query->where('type', (string) $filters['type']);
        }

        if (! empty($filters['domaine'])) {
            $domaine = mb_strtolower((string) $filters['domaine']);
            $query->whereHas('domaines', fn (Builder $relation) => $relation->whereRaw('LOWER(nom) = ?', [$domaine]));
        }

        $sortBy = in_array(($filters['sort_by'] ?? 'nom'), ['nom', 'ville', 'created_at'], true) ? $filters['sort_by'] : 'nom';
        $sortOrder = ($filters['sort_order'] ?? 'asc') === 'desc' ? 'desc' : 'asc';
        $query->orderBy($sortBy, $sortOrder);

        return $query;
    }
}
