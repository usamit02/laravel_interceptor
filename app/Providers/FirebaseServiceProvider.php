<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
class FirebaseServiceProvider extends ServiceProvider
{
    protected $defer = true;
    public function register(): void
    {
        $this->app->singleton(\Kreait\Firebase::class, function () {
            $path=base_path()."/../private_ini/firebase/salon-clife.json";
            $serviceAccount = ServiceAccount::fromJsonFile($path);
            return (new Factory())->withServiceAccount($serviceAccount)->create();
        });
    }
    public function provides(): array
    {
        return [\Kreait\Firebase::class];
    }
}
