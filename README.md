### php-bignumber

![release](https://img.shields.io/badge/release-1.0.1-green.svg) ![php](https://img.shields.io/badge/php-%3E=5.3-green.svg) ![downloads](https://img.shields.io/badge/downloads-3.35k-green.svg)

## About

[中文文档](./README_zh.md)

The integer size in PHP is platform-dependent. The maximum size is usually 2 billion, and the maximum size on 64-bit platforms is usually 9E18.

Floating-point Numbers have limited precision and depend on the system, so never trust floating-point Numbers to be accurate to the last bit, and never compare two floating-point Numbers to be equal.

When the business scenario needs to deal with a large range of values or needs to accurately deal with floating point values, arbitrary precision mathematical functions should be used, such as: trading system, e-commerce system, etc.

The current project encapsulates arbitrary precision mathematical functions to make it easier to solve large number and floating point precision problems in PHP.

<br>
<br>

##  Installation

First please make sure your PHP has been installed and the BC Math extension, if not support, specific installation reference website: http://php.net/manual/en/bc.installation.php

See the way:

	php -info | grep bcmath

If you can see the output

	bcmath
	bcmath.scale => 0 => 0

BC Math is available

Start the installation:

#### 1. Way 1: By composer

	composer require chawuciren/bignumber

#### 2. Way 2: Directly download and include

Download the source code directly, introducing src/bignumber.php

<br>
<br>

## Begin to use

Initialization of the incoming numeric string should be used, such as a out of numerical and later returned to the front interface, the type of stored in the database as a `DECIMAL`, should first initialize the value of the `BigNumber` will be removed, and then used in the code `BigNumber` calculated, after the return to use on interface: value () method for numerical output string

#### 1. Way 1: use new statements

    use \chawuciren\BigNumber;

	$number = new BigNumber('0.002', 3);

#### 2. Way 2: use the static method build

    use \chawuciren\BigNumber;

	$number = BigNumber::build('0.002', 3);

#### 3. Way 3: assign values using the valueOf method

    use \chawuciren\BigNumber;

	$number = new BigNumber();
	$number->valueOf('0.002', 3);

<br>
<br>

## Sample

    use \chawuciren\BigNumber;

	$number = new BigNumber('1.0001', 4);
    $number->add('0.0004')->sub('1')->mul('4')->div('5');
    var_dump($number->value()); //string(5) "0.0002"

    $number2 = new BigNumber('0.0002');
    var_dump($number->eq($number2)) //bool true

<br>
<br>

## Methods list

#### 1.valueOf

Set a value to the BigNumber instance

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | 字符串或BigNumber类型的数字 |
| scale| Int | 数字精度 |

##### Return value: BigNumber(Current instance)

##### Sample:

	$number = new \chawuciren\BigNumber();
	$number->valueOf('0.002', 3);
	var_dump($number); //object(chawuciren\BigNumber)

<br>

#### 2.toString

Returns a value as a string

##### Parameters:

No parameters

##### Reture value: String(Current value)

##### Sample:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$str = $number->toString();
	var_dump($str); //string(5) "0.002"

#### 3.value

Returns a value of type string, currently an alias of the toString method

##### Sample:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$str = $number->value();
	var_dump($str); //string(5) "0.002"

<br>

#### 4.add

Adds the current value plus the number value passed in

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The value used to add |

##### Reture value: BigNumber(Current instance)

##### Sample:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$number->add('0.003');
	var_dump($number->value()); //string(5) "0.005"

<br>

#### 5.sub

Subtracts the current value from the number value passed in

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The value used to subtract |

##### Reture value: BigNumber(Current instance)

##### Sample:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$number->sub('0.001');
	var_dump($number->value()); //string(5) "0.001"

<br>

#### 6.mul

Multiply the current value by the number value passed in

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The number used to multiply |

##### Reture value: BigNumber(Current instance)

##### Sample:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$number->sub('0.001');
	var_dump($number->value()); //string(5) "0.001"

<br>

#### 7.div

Divide the current value by the number value passed in

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | Divide the current value by the number value passed in |

##### Reture value: BigNumber(Current instance)

##### Sample:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$number->div('2');
	var_dump($number->value()); //string(5) "0.001"

<br>

#### 8.mod

Modulates the current value with the number value passed in

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The value used to take a modulus |

##### Reture value: BigNumber(Current instance)

##### Sample:

	$number = new \chawuciren\BigNumber('108');
	$number->mod('10');
	var_dump($number->value()); //string(1) "8"

<br>

#### 9.pow

Take the current value to the number power

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The number of powers |

##### Reture value: BigNumber(Current instance)

##### Sample:

	$number = new \chawuciren\BigNumber('2');
	$number->pow('2');
	var_dump($number->value()); //string(1) "4"

<br>

#### 10.sqrt

Take the square root of the current value

##### Parameters:

No parameters

##### Reture value: BigNumber(Current instance)

##### Sample:

	$number = new \chawuciren\BigNumber('16');
	$number->sqrt();
	var_dump($number->value()); //string(1) "4"

<br>

#### 11.eq

Determine whether the current value equals the value of number

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The rvalue participating in the judgment |


##### Reture value: Bool (True: equal; False: no equal)

##### Sample:

	$number = new \chawuciren\BigNumber('0.00000000000000000001', 20);
	$number2 = new \chawuciren\BigNumber('0.00000000000000000001', 20);
	var_dump($number->eq($number2)); //bool(true)

<br>

#### 12.gt

Determine whether the current value is greater than the number value

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The rvalue participating in the judgment |


##### Reture value: Bool (True: greater than; False: no more than)

##### Sample:

	$number = new \chawuciren\BigNumber('0.00000000000000000002', 20);
	$number2 = new \chawuciren\BigNumber('0.00000000000000000001', 20);
	var_dump($number->gt($number2)); //bool(true)

<br>

#### 13.egt

Determine whether the current value is greater than or equal to the number value

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The rvalue participating in the judgment |


##### Reture value: Bool (True: greater than or equal to; False: not greater than and not equal to)

##### Sample:

	$number = new \chawuciren\BigNumber('0.00000000000000000002', 20);
	$number2 = new \chawuciren\BigNumber('0.00000000000000000001', 20);
	var_dump($number->egt($number2)); //bool(true)

<br>

#### 14.lt

Determine whether the current value is less than the number value

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber | The rvalue participating in the judgment |


##### Reture value: Bool (True: less than; False: no less than)

##### Sample:

	$number = new \chawuciren\BigNumber('0.00000000000000000002', 20);
	$number2 = new \chawuciren\BigNumber('0.00000000000000000001', 20);
	var_dump($number->lt($number2)); //bool(false)

<br>

#### 15.elt

Determine whether the current value is less than or equal to the value of number

##### Parameters:

| Parameter names | Type | Instructions |
|--|--|--|
| number | String/BigNumber |  The rvalue participating in the judgment |


##### Reture value: Bool (True: less than or equal to; False: not less than and not equal to)

##### Sample:

	$number = new \chawuciren\BigNumber('0.00000000000000000002', 20);
	$number2 = new \chawuciren\BigNumber('0.00000000000000000001', 20);
	var_dump($number->lt($number2)); //bool(false)

<br>
