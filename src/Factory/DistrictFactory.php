<?php

namespace App\Factory;

use App\Entity\District;
use App\Repository\DistrictRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<District>
 *
 * @method        District|Proxy                     create(array|callable $attributes = [])
 * @method static District|Proxy                     createOne(array $attributes = [])
 * @method static District|Proxy                     find(object|array|mixed $criteria)
 * @method static District|Proxy                     findOrCreate(array $attributes)
 * @method static District|Proxy                     first(string $sortedField = 'id')
 * @method static District|Proxy                     last(string $sortedField = 'id')
 * @method static District|Proxy                     random(array $attributes = [])
 * @method static District|Proxy                     randomOrCreate(array $attributes = [])
 * @method static DistrictRepository|RepositoryProxy repository()
 * @method static District[]|Proxy[]                 all()
 * @method static District[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static District[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static District[]|Proxy[]                 findBy(array $attributes)
 * @method static District[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static District[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class DistrictFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'color_code' => self::faker()->hexColor(),
            'name' => self::faker()->country(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(District $district): void {})
        ;
    }

    protected static function getClass(): string
    {
        return District::class;
    }
}
