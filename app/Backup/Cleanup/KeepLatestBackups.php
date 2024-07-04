<?php
// app/Backup/Cleanup/KeepLatestBackups.php

namespace App\Backup\Cleanup;

use Spatie\Backup\Tasks\Cleanup\CleanupStrategy;
use Spatie\Backup\BackupDestination\BackupCollection;
use Spatie\Backup\BackupDestination\BackupDestination;

class KeepLatestBackups extends CleanupStrategy
{
    public function deleteOldBackups(BackupCollection $backups)
    {
        // Sort the backups by date in descending order
        $backups = $backups->sortByDesc('date');

        // Keep only the latest 5 backups
        $backupsToKeep = $backups->slice(0, 5);

        // Delete old backups except those to keep
        foreach ($backups as $backup) {
            if (!$backupsToKeep->contains($backup)) {
                $backup->delete();
            }
        }
    }
}
