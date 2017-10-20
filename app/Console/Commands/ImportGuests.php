<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Address;
use App\Guest;

class ImportGuests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:guests {file_path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the guest list.';

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
     * @return mixed
     */
    public function handle()
    {
        //grab the file
		$skipped = 0;
		$headers = false;
		$file = $this->argument('file_path');
		$this->info("FILE IS '$file'");

		if (!$file || !file_exists($file)) {
			$this->error("File '$file' does not exist.");
		}

		try {
			$fp = fopen($file, 'r');
			while (($line = fgetcsv($fp))) {
				if (!$headers) {
					$headers = true;
					continue;
				}

				$partyName = $line[0];
				$addrString = str_replace('  ', ' ', $line[1]);
				$totalAdults = $line[2];
				$totalChildren = $line[3];
				$totalExpected = $line[4];

				if (!$partyName || !$addrString) {
					$skipped++;
					continue;
				}

				// parse address
				$split = explode(',', $addrString);
				$last = array_pop($split);
				$lastSplit = explode(' ', trim($last));

				if (count($lastSplit) >= 3) {
					$zip = array_pop($lastSplit);
					$state = array_pop($lastSplit);
					$city = implode(' ', $lastSplit);

				}else if (count($lastSplit) === 2) {
					$zip = array_pop($lastSplit);
					$state = array_pop($lastSplit);
					$city = array_pop($split);

				}else {
					$zip = $last;
					$state = array_pop($split);
					$city = array_pop($split);
				}

				$street = str_replace(',', '', implode(' ', $split));

				if (!$city || !$street) {
					$skipped++;
					continue;
				}

				$addr = new Address;
				$addr->street = $street;
				$addr->city = $city;
				$addr->state = $state;
				$addr->zip = $zip;
				$addr->save();

				$guest = new Guest;
				$guest->address_id = $addr->id;
				$guest->party_name = $partyName;
				$guest->total_adults = $totalAdults;
				$guest->total_children = $totalChildren;
				$guest->total_expected = $totalExpected;
				$guest->save();
				
				// print_r($addr->toArray());
			}

			$this->info('Total skipped: ' . $skipped);
		}catch (\Exception $e) {
			$this->error("Encountered exception while importing file. '$e'");
		}
    }
}
