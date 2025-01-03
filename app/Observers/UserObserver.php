<?php

namespace App\Observers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function created($model)
    {
        $this->logOperation($model, 'Create');
    }

    public function updated($model)
    {
        $this->logOperation($model, 'Update');
    }

    public function deleted($model)
    {
        $this->logOperation($model, 'Delete');
    }

    public function restored($model)
    {
        $this->logOperation($model, 'Restore');
    }

    public function forceDeleted($model)
    {
        $this->logOperation($model, 'Force Delete');
    }

    /**
     * Log the operation performed on the model (Create, Update, Delete, Restore, Force Delete)
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $operation
     * @return void
     */
    protected function logOperation($model, $operation)
    {
        // Get changes and original attributes
        $changes = $model->getChanges();
        $original = $model->getOriginal();

        $changesWithPrevious = [];

        // Define attributes to exclude from logging (timestamps or any other fields you don't need)
        $excludeAttributes = ['created_at', 'updated_at'];

        // Handle Create operation
        if ($operation == 'Create') {
            // Only log the attributes that are part of the model (ignore `original` as it's empty for create)
            foreach ($model->getAttributes() as $attribute => $newValue) {
                // Skip excluded attributes
                if (in_array($attribute, $excludeAttributes)) {
                    continue;
                }

                // Log only the current value for create operation (no previous value)
                $changesWithPrevious[$attribute] = [
                    // 'previous' => null,  // No previous value for Create
                    'current' => $newValue,
                ];
            }
        }

        // Handle Update operation
        elseif ($operation == 'Update') {
            foreach ($changes as $attribute => $newValue) {
                // Skip excluded attributes
                if (in_array($attribute, $excludeAttributes)) {
                    continue;
                }

                // Get the previous value from the original attributes
                $previousValue = $original[$attribute] ?? null;

                // Log both previous and current values for updated attributes
                $changesWithPrevious[$attribute] = [
                    'previous' => $previousValue,
                    'current' => $newValue,
                ];
            }
        }

        // Handle Delete operation
        elseif ($operation == 'Delete') {
            foreach ($model->getOriginal() as $attribute => $value) {
                // Skip excluded attributes
                if (in_array($attribute, $excludeAttributes)) {
                    continue;
                }

                // For delete, log the original values as "previous", no "current" value
                $changesWithPrevious[$attribute] = [
                    'previous' => $value,
                    'current' => null,  // No current value for deleted records
                ];
            }
        }

        // Handle Restore operation (same as Update but reverse of Delete)
        elseif ($operation == 'Restore') {
            foreach ($changes as $attribute => $newValue) {
                // Skip excluded attributes
                if (in_array($attribute, $excludeAttributes)) {
                    continue;
                }

                // For restore, no previous value available, but we log the current value as "restored"
                $changesWithPrevious[$attribute] = [
                    'previous' => null,
                    'current' => $newValue,
                ];
            }
        }

        // Handle Force Delete operation (same as Delete)
        elseif ($operation == 'Force Delete') {
            foreach ($model->getOriginal() as $attribute => $value) {
                // Skip excluded attributes
                if (in_array($attribute, $excludeAttributes)) {
                    continue;
                }

                // For force delete, log the original values as "previous", no "current" value
                $changesWithPrevious[$attribute] = [
                    'previous' => $value,
                    'current' => null,  // No current value for force-deleted records
                ];
            }
        }

        // Store the log in the database
        Log::create([
            'user_id' => Auth::id(),
            'model_name' => strtolower(class_basename($model::class)),  // Store only the model name (e.g. 'user')
            'model_id' => $model->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'action' => $operation,
            'changes' => json_encode($changesWithPrevious),  // Store the changes with previous and current values
        ]);
    }
}
