<?php namespace Karl456\Teamwork;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\ServiceProvider;

class TeamworkServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('karl456.teamwork', function($app)
        {
            $client = new \Karl456\Teamwork\Client(new Guzzle,
                $app['config']->get('services.teamwork.key'),
                $app['config']->get('services.teamwork.url')
            );

            return new \Karl456\Teamwork\Factory($client);
        });

        $this->app->bind('Karl456\Teamwork\Factory', 'karl456.teamwork');
    }

}