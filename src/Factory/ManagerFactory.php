<?php

namespace App\Factory;

use App\Entity\Manager;
use App\Repository\ManagerRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Manager>
 *
 * @method        Manager|Proxy                     create(array|callable $attributes = [])
 * @method static Manager|Proxy                     createOne(array $attributes = [])
 * @method static Manager|Proxy                     find(object|array|mixed $criteria)
 * @method static Manager|Proxy                     findOrCreate(array $attributes)
 * @method static Manager|Proxy                     first(string $sortedField = 'id')
 * @method static Manager|Proxy                     last(string $sortedField = 'id')
 * @method static Manager|Proxy                     random(array $attributes = [])
 * @method static Manager|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ManagerRepository|RepositoryProxy repository()
 * @method static Manager[]|Proxy[]                 all()
 * @method static Manager[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Manager[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Manager[]|Proxy[]                 findBy(array $attributes)
 * @method static Manager[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Manager[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ManagerFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->text(255),
            'firstname' => self::faker()->text(255),
            'lastname' => self::faker()->text(255),
            'phonenumber' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Manager $manager): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Manager::class;
    }
}
