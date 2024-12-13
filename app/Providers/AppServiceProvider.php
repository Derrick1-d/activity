<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!Type::hasType('enum')) {
            Type::addType('enum', EnumType::class);
        }
    }
}

// Define EnumType outside of the AppServiceProvider class
class EnumType extends Type
{
    const ENUM = 'enum';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "ENUM('completed', 'pending', 'In Progress')";
    }

    public function getName()
    {
        return self::ENUM;
    }
}
