<?php

class standard_test extends CI_TestCase
{
    public function test_bootstrap()
    {
        if (is_php('5.5')) {
            return $this->markTestSkipped('All array functions are already available on PHP 5.5');
        }

        $this->assertTrue(function_exists('array_column'));

        if (!is_php('5.4')) {
            $this->assertTrue(function_exists('hex2bin'));
        }

        if (!is_php('5.3')) {
            $this->assertTrue(function_exists('array_replace'));
            $this->assertTrue(function_exists('array_replace_recursive'));
            $this->assertTrue(function_exists('quoted_printable_encode'));
        }
    }

    // ------------------------------------------------------------------------

    /**
     * array_column() test.
     *
     * Borrowed from PHP's own tests
     *
     * @depends	test_bootstrap
     */
    public function test_array_column()
    {
        // Basic tests

        $input = [
            [
                'id'         => 1,
                'first_name' => 'John',
                'last_name'  => 'Doe',
            ],
            [
                'id'         => 2,
                'first_name' => 'Sally',
                'last_name'  => 'Smith',
            ],
            [
                'id'         => 3,
                'first_name' => 'Jane',
                'last_name'  => 'Jones',
            ],
        ];

        // Ensure internal array position doesn't break it
        next($input);

        $this->assertEquals(
            ['John', 'Sally', 'Jane'],
            array_column($input, 'first_name')
        );

        $this->assertEquals(
            [1, 2, 3],
            array_column($input, 'id')
        );

        $this->assertEquals(
            [
                1 => 'Doe',
                2 => 'Smith',
                3 => 'Jones',
            ],
            array_column($input, 'last_name', 'id')
        );

        $this->assertEquals(
            [
                'John'  => 'Doe',
                'Sally' => 'Smith',
                'Jane'  => 'Jones',
            ],
            array_column($input, 'last_name', 'first_name')
        );

        // Object key search

        $f = new Foo();
        $b = new Bar();

        $this->assertEquals(
            ['Doe', 'Smith', 'Jones'],
            array_column($input, $f)
        );

        $this->assertEquals(
            [
                'John'  => 'Doe',
                'Sally' => 'Smith',
                'Jane'  => 'Jones',
            ],
            array_column($input, $f, $b)
        );

        // NULL parameters

        $input = [
            456 => [
                'id'    => '3',
                'title' => 'Foo',
                'date'  => '2013-03-25',
            ],
            457 => [
                'id'    => '5',
                'title' => 'Bar',
                'date'  => '2012-05-20',
            ],
        ];

        $this->assertEquals(
            [
                3 => [
                    'id'    => '3',
                    'title' => 'Foo',
                    'date'  => '2013-03-25',
                ],
                5 => [
                    'id'    => '5',
                    'title' => 'Bar',
                    'date'  => '2012-05-20',
                ],
            ],
            array_column($input, null, 'id')
        );

        $this->assertEquals(
            [
                [
                    'id'    => '3',
                    'title' => 'Foo',
                    'date'  => '2013-03-25',
                ],
                [
                    'id'    => '5',
                    'title' => 'Bar',
                    'date'  => '2012-05-20',
                ],
            ],
            array_column($input, null, 'foo')
        );

        $this->assertEquals(
            [
                [
                    'id'    => '3',
                    'title' => 'Foo',
                    'date'  => '2013-03-25',
                ],
                [
                    'id'    => '5',
                    'title' => 'Bar',
                    'date'  => '2012-05-20',
                ],
            ],
            array_column($input, null)
        );

        // Data types

        $fh = fopen(__FILE__, 'r', true);
        $stdClass = new stdClass();
        $input = [
            [
                'id'    => 1,
                'value' => $stdClass,
            ],
            [
                'id'    => 2,
                'value' => 34.2345,
            ],
            [
                'id'    => 3,
                'value' => true,
            ],
            [
                'id'    => 4,
                'value' => false,
            ],
            [
                'id'    => 5,
                'value' => null,
            ],
            [
                'id'    => 6,
                'value' => 1234,
            ],
            [
                'id'    => 7,
                'value' => 'Foo',
            ],
            [
                'id'    => 8,
                'value' => $fh,
            ],
        ];

        $this->assertEquals(
            [
                $stdClass,
                34.2345,
                true,
                false,
                null,
                1234,
                'Foo',
                $fh,
            ],
            array_column($input, 'value')
        );

        $this->assertEquals(
            [
                1 => $stdClass,
                2 => 34.2345,
                3 => true,
                4 => false,
                5 => null,
                6 => 1234,
                7 => 'Foo',
                8 => $fh,
            ],
            array_column($input, 'value', 'id')
        );

        // Numeric column keys

        $input = [
            ['aaa', '111'],
            ['bbb', '222'],
            ['ccc', '333', -1 => 'ddd'],
        ];

        $this->assertEquals(
            ['111', '222', '333'],
            array_column($input, 1)
        );

        $this->assertEquals(
            [
                'aaa' => '111',
                'bbb' => '222',
                'ccc' => '333',
            ],
            array_column($input, 1, 0)
        );

        $this->assertEquals(
            [
                'aaa' => '111',
                'bbb' => '222',
                'ccc' => '333',
            ],
            array_column($input, 1, 0.123)
        );

        $this->assertEquals(
            [
                0     => '111',
                1     => '222',
                'ddd' => '333',
            ],
            array_column($input, 1, -1)
        );

        // Non-existing columns

        $this->assertEquals([], array_column($input, 2));
        $this->assertEquals([], array_column($input, 'foo'));
        $this->assertEquals(
            ['aaa', 'bbb', 'ccc'],
            array_column($input, 0, 'foo')
        );
        $this->assertEquals([], array_column($input, 3.14));

        // One-dimensional array
        $this->assertEquals([], array_column(['foo', 'bar', 'baz'], 1));

        // Columns not present in all rows

        $input = [
            ['a' => 'foo', 'b' => 'bar', 'e' => 'bbb'],
            ['a' => 'baz', 'c' => 'qux', 'd' => 'aaa'],
            ['a' => 'eee', 'b' => 'fff', 'e' => 'ggg'],
        ];

        $this->assertEquals(
            ['qux'],
            array_column($input, 'c')
        );

        $this->assertEquals(
            ['baz' => 'qux'],
            array_column($input, 'c', 'a')
        );

        $this->assertEquals(
            [
                0     => 'foo',
                'aaa' => 'baz',
                1     => 'eee',
            ],
            array_column($input, 'a', 'd')
        );

        $this->assertEquals(
            [
                'bbb' => 'foo',
                0     => 'baz',
                'ggg' => 'eee',
            ],
            array_column($input, 'a', 'e')
        );

        $this->assertEquals(
            ['bar', 'fff'],
            array_column($input, 'b')
        );

        $this->assertEquals(
            [
                'foo' => 'bar',
                'eee' => 'fff',
            ],
            array_column($input, 'b', 'a')
        );
    }

    // ------------------------------------------------------------------------

    /**
     * hex2bin() tests.
     *
     * @depends	test_bootstrap
     */
    public function test_hex2bin()
    {
        if (is_php('5.4')) {
            return $this->markTestSkipped('hex2bin() is already available on PHP 5.4');
        }

        $this->assertEquals("\x03\x04", hex2bin('0304'));
        $this->assertEquals('', hex2bin(''));
        $this->assertEquals("\x01\x02\x03", hex2bin(new FooHex()));
    }

    // ------------------------------------------------------------------------

    /**
     * array_replace(), array_replace_recursive() tests.
     *
     * Borrowed from PHP's own tests
     *
     * @depends	test_bootstrap
     */
    public function test_array_replace_recursive()
    {
        if (is_php('5.3')) {
            return $this->markTestSkipped('array_replace() and array_replace_recursive() are already available on PHP 5.3');
        }

        $array1 = [
            0       => 'dontclobber',
            '1'     => 'unclobbered',
            'test2' => 0.0,
            'test3' => [
                'testarray2' => true,
                1            => [
                    'testsubarray1' => 'dontclobber2',
                    'testsubarray2' => 'dontclobber3',
                ],
            ],
        ];

        $array2 = [
            1       => 'clobbered',
            'test3' => [
                'testarray2' => false,
            ],
            'test4' => [
                'clobbered3' => [0, 1, 2],
            ],
        ];

        // array_replace()
        $this->assertEquals(
            [
                0       => 'dontclobber',
                1       => 'clobbered',
                'test2' => 0.0,
                'test3' => [
                    'testarray2' => false,
                ],
                'test4' => [
                    'clobbered3' => [0, 1, 2],
                ],
            ],
            array_replace($array1, $array2)
        );

        // array_replace_recursive()
        $this->assertEquals(
            [
                0       => 'dontclobber',
                1       => 'clobbered',
                'test2' => 0.0,
                'test3' => [
                    'testarray2' => false,
                    1            => [
                        'testsubarray1' => 'dontclobber2',
                        'testsubarray2' => 'dontclobber3',
                    ],
                ],
                'test4' => [
                    'clobbered3' => [0, 1, 2],
                ],
            ],
            array_replace_recursive($array1, $array2)
        );
    }

    // ------------------------------------------------------------------------

    /**
     * quoted_printable_encode() tests.
     *
     * Borrowed from PHP's own tests
     *
     * @depends	test_bootstrap
     */
    public function test_quoted_printable_encode()
    {
        if (is_php('5.3')) {
            return $this->markTestSkipped('quoted_printable_encode() is already available on PHP 5.3');
        }

        // These are actually imap_8bit() tests:
        $this->assertEquals("String with CRLF at end=20\r\n", quoted_printable_encode("String with CRLF at end \r\n"));
        // ext/imap/tests/imap_8bit_basic.phpt says for this line:
        // NB this appears to be a bug in cclient; a space at end of string should be encoded as =20
        $this->assertEquals('String with space at end ', quoted_printable_encode('String with space at end '));
        $this->assertEquals('String with tabs =09=09 in middle', quoted_printable_encode("String with tabs \t\t in middle"));
        $this->assertEquals('String with tab at end =09', quoted_printable_encode("String with tab at end \t"));
        $this->assertEquals('=00=01=02=03=04=FE=FF=0A=0D', quoted_printable_encode("\x00\x01\x02\x03\x04\xfe\xff\x0a\x0d"));

        if (function_exists('imap_8bit')) {
            return $this->markTestIncomplete('imap_8bit() exists and is called as an alias for quoted_printable_encode()');
        }

        // And these are from ext/standard/tests/strings/quoted_printable_encode_002.phpt:
        $this->assertEquals(
            "=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=\r\n"
            ."=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=\r\n"
            ."=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=\r\n"
            ."=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=\r\n"
            ."=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=\r\n"
            ."=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=\r\n"
            ."=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=\r\n"
            .'=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00=00',
            $d = quoted_printable_encode(str_repeat("\0", 200))
        );
        $this->assertEquals(str_repeat("\x0", 200), quoted_printable_decode($d));
        $this->assertEquals(
            "=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=\r\n"
            ."=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=\r\n"
            ."=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=\r\n"
            ."=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=\r\n"
            ."=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=\r\n"
            ."=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=\r\n"
            ."=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=\r\n"
            ."=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=\r\n"
            ."=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =\r\n"
            ."=D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=\r\n"
            ."=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=\r\n"
            ."=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=\r\n"
            ."=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=\r\n"
            ."=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=\r\n"
            ."=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=\r\n"
            ."=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=\r\n"
            ."=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=\r\n"
            ."=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=\r\n"
            ."=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=\r\n"
            ."=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =\r\n"
            ."=D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=\r\n"
            ."=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=\r\n"
            ."=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=\r\n"
            ."=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=\r\n"
            ."=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=\r\n"
            ."=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=\r\n"
            ."=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=\r\n"
            ."=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=\r\n"
            ."=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=\r\n"
            ."=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=\r\n"
            ."=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=\r\n"
            ."=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =\r\n"
            ."=D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=\r\n"
            ."=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=\r\n"
            ."=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=\r\n"
            ."=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=\r\n"
            ."=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=\r\n"
            ."=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=\r\n"
            ."=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=\r\n"
            ."=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=\r\n"
            ."=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=\r\n"
            ."=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=\r\n"
            ."=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =\r\n"
            ."=D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=\r\n"
            ."=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=\r\n"
            ."=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=\r\n"
            ."=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=\r\n"
            ."=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=\r\n"
            ."=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=\r\n"
            ."=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=\r\n"
            ."=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=\r\n"
            ."=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=\r\n"
            ."=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=\r\n"
            ."=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=\r\n"
            ."=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =\r\n"
            ."=D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=\r\n"
            ."=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=\r\n"
            ."=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=\r\n"
            ."=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=8E=D0=BD=D0=B8=\r\n"
            ."=D0=BA=D0=BE=D0=B4=D0=B5=D1=81=D1=82=D1=80=D0=BE=D0=BA=D0=B0 =D0=B2 =D1=\r\n"
            .'=8E=D0=BD=D0=B8=D0=BA=D0=BE=D0=B4=D0=B5',
            $d = quoted_printable_encode(str_repeat('строка в юникоде', 50))
        );
        $this->assertEquals(str_repeat('строка в юникоде', 50), quoted_printable_decode($d));
        $this->assertEquals('this is a foo', quoted_printable_encode(new FooObject()));
    }
}

// ------------------------------------------------------------------------

class Foo
{
    public function __toString()
    {
        return 'last_name';
    }
}

class Bar
{
    public function __toString()
    {
        return 'first_name';
    }
}

class FooHex
{
    public function __toString()
    {
        return '010203';
    }
}

class FooObject
{
    public function __toString()
    {
        return 'this is a foo';
    }
}
