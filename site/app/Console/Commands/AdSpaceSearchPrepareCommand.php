<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AdSpaceSearchPrepareCommand extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'larasearch:adspace';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = '构建 AdSpace 的搜索环境.';

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
    $this->call('larasearch:paths:adspace');
    $this->call('larasearch:reindex:adspace');
  }
}
