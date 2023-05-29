<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;
use Lemaur\LaravelTypedConfig\Tests\Fixtures\TestEnum;

it('returns a string type', function (): void {
    config()->set('test.string', 'string value');

    expect(config()->string('test.string'))->toBeInstanceOf(Stringable::class);
    expect(config()->string('test.string')->toString())->toBe('string value');
});

it('returns a boolean type', function (): void {
    config()->set('test.boolean', true);

    expect(config()->boolean('test.boolean'))->toBeBool()->toBeTrue();
});

it('returns a integer type', function (): void {
    config()->set('test.integer', 123);

    expect(config()->integer('test.integer'))->toBeInt()->toBe(123);
});

it('returns a float type', function (): void {
    config()->set('test.float', 1.23);

    expect(config()->float('test.float'))->toBeFloat()->toBe(1.23);
});

it('returns a date type', function (): void {
    config()->set('test.date', '2023-01-01 01:00:00');

    expect(config()->date('test.date'))
        ->toBeInstanceOf(Carbon::class)
        ->format('Y-m-d H:i:s')
        ->toBe('2023-01-01 01:00:00');
});

it('returns an enum type', function (): void {
    config()->set('test.enum', 'one');

    expect(config()->enum('test.enum', TestEnum::class))
        ->toBeInstanceOf(TestEnum::class)
        ->toBe(TestEnum::ONE);
});

it('returns a collection type', function (): void {
    config()->set('test.collect', [
        'foo' => 'John',
        'baz' => 'Jane',
        'bar' => 'Jack',
    ]);

    expect(config()->collect('test.collect'))
        ->toBeInstanceOf(Collection::class)
        ->toMatchArray([
            'foo' => 'John',
            'baz' => 'Jane',
            'bar' => 'Jack',
        ]);
});
