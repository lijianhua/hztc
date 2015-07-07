<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BuildAdSpaceSearchIndex extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'larasearch:reindex:adspace';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Index AdSpace.';

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
  public function fire()
  {
    $this->call('larasearch:reindex', [
      'model'       => ['\App\Models\AdSpace'],
      '--relations' => [
        '\App\Models\Address',
        '\App\Models\AdPrice',
        '\App\Models\AdCategory',
      ]
    ]);
  }
}
