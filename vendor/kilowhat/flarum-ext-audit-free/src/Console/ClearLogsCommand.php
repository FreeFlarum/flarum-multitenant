<?php

namespace Kilowhat\Audit\Console;

use Flarum\Extension\ExtensionManager;
use Illuminate\Console\Command;
use Illuminate\Database\Connection;
use Kilowhat\Audit\AuditLogger;

class ClearLogsCommand extends Command
{
    protected $signature = 'kilowhat:audit:clear {--reset : Delete all data, database tables and disable extension} {--force : Don\'t ask for confirmation}';
    protected $description = 'Permanently destroy audit log entries';

    public function handle(Connection $db, ExtensionManager $manager)
    {
        if ($this->option('reset')) {
            if (!$this->option('force') && !$this->confirm('This will delete the audit log database table and disable the extension. Continue?')) {
                $this->warn('Aborting.');
                return;
            }

            AuditLogger::$disabled = true;

            $db->getSchemaBuilder()->dropIfExists('kilowhat_audit_log');
            $this->info('Table deleted.');

            // Delete both free and pro migrations (which are identical) to ensure they will run again next time either of the extensions are re-enabled
            $db->table('migrations')->where('extension', 'like', 'kilowhat-audit-%')->delete();
            $this->info('Migration entries deleted.');

            $manager->disable('kilowhat-audit-free');
            $this->info('Extension disabled.');

            $this->info('All done!');

            return;
        }

        $this->warn('No option chosen. Run with --help for the list of options.');
    }
}
