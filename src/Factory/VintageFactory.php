<?php

namespace App\Factory;

use App\Entity\Vintage;
use App\Repository\VintageRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Vintage>
 *
 * @method        Vintage|Proxy                     create(array|callable $attributes = [])
 * @method static Vintage|Proxy                     createOne(array $attributes = [])
 * @method static Vintage|Proxy                     find(object|array|mixed $criteria)
 * @method static Vintage|Proxy                     findOrCreate(array $attributes)
 * @method static Vintage|Proxy                     first(string $sortedField = 'id')
 * @method static Vintage|Proxy                     last(string $sortedField = 'id')
 * @method static Vintage|Proxy                     random(array $attributes = [])
 * @method static Vintage|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VintageRepository|RepositoryProxy repository()
 * @method static Vintage[]|Proxy[]                 all()
 * @method static Vintage[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Vintage[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Vintage[]|Proxy[]                 findBy(array $attributes)
 * @method static Vintage[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Vintage[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VintageFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'card' => null,
            'latitude' => self::faker()->randomFloat(6, 0, 50),
            'longitude' => self::faker()->randomFloat(6, 0, 50),
            'name' => self::faker()->city(),
            'size' => self::faker()->randomFloat(2, 0, 50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Vintage $vintage): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Vintage::class;
    }
}
