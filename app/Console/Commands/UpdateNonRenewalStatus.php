<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateNonRenewalStatus extends Command
{
    protected $signature = 'members:update-status';

    protected $description = 'Update member statuses based on expiry dates and renewal conditions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info('Cron Job Started. Update member statuses based on expiry dates and renewal conditions');

        $today = now()->format('m-d'); // Get today's date in MM-DD format

        if ($today === '10-01') {
            // On 1st October: Update Non-renewal members to Non-Financial
            $this->updateToNonFinancial();
        } elseif ($today === '07-01') {
            // On 1st July: Update all expired active accounts to Non-renewal
            $this->markExpiredAsNonRenewal();
        } else {
            $this->info('This command is only meant to run on 1st July and 1st October.');
            Log::info('This command is only meant to run on 1st July and 1st October.');
        }

        return 0;
    }

    private function updateToNonFinancial()
    {
        $nonFinancialStatusId = DB::table('membership_status')
            ->where('name', 'Non-Financial')
            ->value('id');

        if (!$nonFinancialStatusId) {
            $this->error('Non-Financial status not found.');
            return;
        }

        $updatedRows = DB::table('members')
            ->join('membership_status', 'members.member_status_id', '=', 'membership_status.id')
            ->where('membership_status.name', 'Non-renewal')
            ->update(['members.member_status_id' => $nonFinancialStatusId]);

        if ($updatedRows > 0) {
            $this->info("Successfully updated {$updatedRows} members to Non-Financial status.");
            Log::info("Successfully updated {$updatedRows} members to Non-Financial status.");
        } else {
            $this->info('No members found with Non-renewal status.');
            Log::info('No members found with Non-renewal status.');
        }
    }

    private function markExpiredAsNonRenewal()
    {
        $nonRenewalStatusId = DB::table('membership_status')
            ->where('name', 'Non-renewal')
            ->value('id');

        if (!$nonRenewalStatusId) {
            $this->error('Non-renewal status not found.');
            return;
        }

        $currentDate = Carbon::now();

        // Update all active members whose membership has expired
        $updatedRows = DB::table('members')
            ->join('additional_member_info', 'members.id', '=', 'additional_member_info.member_id')
            ->join('membership_status', 'members.member_status_id', '=', 'membership_status.id')
            ->where('membership_status.name', 'Active')
            ->whereRaw("STR_TO_DATE(CONCAT(additional_member_info.year_membership_end, '-', 
                          LPAD(additional_member_info.month_membership_end, 2, '0'), '-', 
                          LPAD(additional_member_info.date_membership_end, 2, '0')), '%Y-%m-%d') < ?", [$currentDate])
            ->update(['members.member_status_id' => $nonRenewalStatusId]);

        if ($updatedRows > 0) {
            $this->info("Successfully updated {$updatedRows} members to Non-renewal status.");
            Log::info("Successfully updated {$updatedRows} members to Non-renewal status.");
        } else {
            $this->info('No expired active members found.');
            Log::info('No expired active members found.');
        }
    }
}
