<?php

include('foo.php');

use PHPUnit\Framework\TestCase;

final class FooTest extends TestCase
{
    /**
     * @dataProvider fooProvider
     */
    public function testNoValuesChanged(array $input, array $expected): void
    {
        $this->assertSame($expected, foo($input));
    }

    public function fooProvider()
    {
        yield 'noValuesChange' => [
            [
                [0, 3],
                [6, 10]
            ],
            [
                [0, 3],
                [6, 10]
            ]
        ];
        yield 'merge' => [
            [
                [0, 5],
                [3, 10]
            ],
            [
                [0, 10]
            ]
        ];
        yield 'firstValue' => [
            [
                [0, 5],
                [2, 4]
            ],
            [
                [0, 5]
            ]
        ];
        yield 'mergeValuesAndNoChanges' => [
            [
                [7, 8],
                [3, 6],
                [2, 4]
            ],
            [
                [2, 6],
                [7, 8]
            ]
        ];
        yield 'overlapsValues' => [
            [
                [3, 6],
                [3, 4],
                [15, 20],
                [16, 17],
                [1, 4],
                [6, 10],
                [3, 6]
            ],
            [
                [1, 10],
                [15, 20]
            ]
        ];
    }
}

?>