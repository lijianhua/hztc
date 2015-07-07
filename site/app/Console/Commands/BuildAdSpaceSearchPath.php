<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BuildAdSpaceSearchPath extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'larasearch:paths:adspace';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Build AdSpace search paths.';

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
    $this->call('larasearch:paths', [
      'model'       => ['\App\Models\AdSpace'],
      '--relations' => [
        '\App\Models\Address',
        '\App\Models\AdPrice',
      ],
      '--write-config' => true
    ]);
  }
}
