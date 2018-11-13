<?php

namespace App\Core\Providers;
use App\Core\Common\LoggingConst;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Custom to logs query form database
        $this->databaseLogger();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register services
    }

    /**
     * databaseLogger
     */
    protected function databaseLogger(){
        try{
            if((boolean)Config::get('database.logs')==true){
                DB::listen(function($query) {
                    Log::channel(LoggingConst::SQL_LOG_channel)->debug(
                        $query->sql,
                        $query->bindings,
                        $query->time
                    );
                });
            }
        }catch (\Exception $e){
            Log::error( $e->getMessage());
        }
    }
}
