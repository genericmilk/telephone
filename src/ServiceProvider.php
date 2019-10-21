<?php
    namespace Genericmilk\Telephone;

    class ServiceProvider extends \Illuminate\Support\ServiceProvider{

        public function boot()
        {
            $this->setupConfig(); // Load config

        }
        public function register()
        {
            // Import controllers
            $this->app->make('Genericmilk\Telephone\Telephone');
            
        }

        protected function setupConfig(){

            $configPath = __DIR__ . '/../config/telephone.php';
            $this->publishes([$configPath => $this->getConfigPath()], 'config');
    
        }

        protected function getConfigPath()
        {
            return config_path('telephone.php');
        }

        protected function publishConfig($configPath)
        {
            $this->publishes([$configPath => config_path('telephone.php')], 'config');
        }


    }