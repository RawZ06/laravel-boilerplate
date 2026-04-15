<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    public static function bootAuditable(): void
    {
        static::created(fn (Model $model) => $model->audit('created'));
        static::updated(fn (Model $model) => $model->audit('updated'));
        static::deleted(fn (Model $model) => $model->audit('deleted'));
    }

    protected function audit(string $event): void
    {
        $oldValues = $event === 'created' ? null : $this->getOriginal();
        $newValues = $event === 'deleted' ? null : $this->getAttributes();

        if ($event === 'updated') {
            $changes = $this->getChanges();

            // Get columns to ignore (e.g., remember_token)
            $ignoredColumns = property_exists($this, 'unauditableAttributes') ? $this->unauditableAttributes : [];

            // Remove ignored columns from changes
            $filteredChanges = array_diff_key($changes, array_flip($ignoredColumns));

            // If no changes left after filtering, don't audit
            if (empty($filteredChanges)) {
                return;
            }

            $newValues = $changes;
            $oldValues = array_intersect_key($this->getOriginal(), $newValues);
        }

        // Mask sensitive data (e.g., password)
        $hiddenAudit = property_exists($this, 'hiddenAuditAttributes') ? $this->hiddenAuditAttributes : [];

        if ($oldValues) {
            foreach ($hiddenAudit as $column) {
                if (array_key_exists($column, $oldValues)) {
                    $oldValues[$column] = '[HIDDEN]';
                }
            }
        }

        if ($newValues) {
            foreach ($hiddenAudit as $column) {
                if (array_key_exists($column, $newValues)) {
                    $newValues[$column] = '[HIDDEN]';
                }
            }
        }

        Audit::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'auditable_type' => get_class($this),
            'auditable_id' => $this->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'url' => Request::fullUrl(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    public function audits()
    {
        return $this->morphMany(Audit::class, 'auditable');
    }
}
