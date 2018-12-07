<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Hash;

class JiwanalaAddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jiwanala:add-user {name : username} {email : Email} {password : Secret password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user to record';

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
    public function handle(){
        $this->comment('Process add User: ');
		$fill = [];
		$fill['name'] = $this->argument('name')?: $this->ask('User name:');
		$fill['email'] = $this->argument('email')?: $this->ask('User email:');
		$fill['password'] = Hash::make($this->argument('password')?: $this->ask('User secret password:'));
		$user = new \App\Libraries\Service\Auth\User($fill);
		$user->save();
		$this->info('User: '. $fill['name']. ' added.');
    }
}