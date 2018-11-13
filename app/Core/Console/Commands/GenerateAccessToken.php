<?php

namespace App\Core\Commands\Console;

use App\Core\Dao\SDB;
use Illuminate\Console\Command;
use App\Core\Common\RoleConst;
use Illuminate\Support\Facades\Auth;
use App\Auth\Models\User;
use Illuminate\Support\Facades\Hash;

class GenerateAccessToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'access-token:generate {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user and return access token';

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
        $token = '';
        SDB::beginTransaction();
        try{
            $user = User::where('email',  $this->argument('email'))->first();
            if(!$user->exists()){
                $user= User::create([
                    'name' => 'virtual_'.now()->toDateTimeString(),
                    'email' => $this->argument('email'),
                    'password' =>Hash::make(now()->toDateTimeString()),
                    'role_value'=>RoleConst::PartyRole,
                    'is_active'=>1
                ]);
            }
            // Creating a token without scopes...
            $token = $user->createToken('Party specific token')->accessToken;
            SDB::commit();
        }catch (\Exception $exception){
            SDB::rollBack();
            echo $exception->getMessage();
        }
        echo 'ACCESS TOKEN:'.$token;
    }
}
