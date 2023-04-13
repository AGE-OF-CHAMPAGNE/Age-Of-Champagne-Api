<?php

namespace App\Factory;

use App\Entity\VintageType;
use App\Repository\VintageTypeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<VintageType>
 *
 * @method        VintageType|Proxy                     create(array|callable $attributes = [])
 * @method static VintageType|Proxy                     createOne(array $attributes = [])
 * @method static VintageType|Proxy                     find(object|array|mixed $criteria)
 * @method static VintageType|Proxy                     findOrCreate(array $attributes)
 * @method static VintageType|Proxy                     first(string $sortedField = 'id')
 * @method static VintageType|Proxy                     last(string $sortedField = 'id')
 * @method static VintageType|Proxy                     random(array $attributes = [])
 * @method static VintageType|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VintageTypeRepository|RepositoryProxy repository()
 * @method static VintageType[]|Proxy[]                 all()
 * @method static VintageType[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static VintageType[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static VintageType[]|Proxy[]                 findBy(array $attributes)
 * @method static VintageType[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static VintageType[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VintageTypeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => 'GRAND CRU',
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(VintageType $vintageType): void {})
        ;
    }

    protected static function getClass(): string
    {
        return VintageType::class;
    }
}
