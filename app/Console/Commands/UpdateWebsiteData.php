<?php

namespace App\Console\Commands;

use App\Modules\WebsiteData\Storages\WebsiteDataStorage;
use Illuminate\Console\Command;

class UpdateWebsiteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'website_data:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update websites data and store it to the storage';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param WebsiteDataStorage $data
     * @return int
     */
    public function handle(WebsiteDataStorage $data): int
    {
        $data->update();

        $this->info('Updated');

        return 1;
    }
}
