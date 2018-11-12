### php-bignumber

![release](https://img.shields.io/badge/release-0.1.1-green.svg) ![php](https://img.shields.io/badge/php-%3E=5.3-green.svg) ![downloads](https://img.shields.io/badge/downloads-2.29k-green.svg)

## 关于

PHP 中的整型大小和平台有关，通常最大值是二十亿，64位平台下最大值通常为 9E18，当程序中需要处理的数值超出整形的范围，数值将会被解释为浮点数。

浮点数的精度有限并取决于系统，所以永远不要相信浮点数结果精确到了最后一位，也永远不要比较两个浮点数是否相等。

当业务场景需要处理的数值范围比较大或者需要精确处理浮点数值时，应该使用任意精度数学函数，如：交易系统、电商系统等。

当前项目是对任意精度数学函数的封装，用于更方便的解决PHP中大数字和浮点数精度问题。

<br>
<br>

##  安装方式

首先请确保你的 PHP 已经安装并支持 BC Math 扩展，如果不支持，具体安装方式参照官网：http://php.net/manual/en/bc.installation.php

查看方式：

	php -info | grep bcmath

如果能够看到输出

	bcmath
	bcmath.scale => 0 => 0

则表示 BC Math 可以使用

开始安装：

#### 1.安装方式一，通过composer 安装

	composer require chawuciren/bignumber

#### 2.安装方式二，直接下载并 include

直接下载源码，引入 src/BigNumber.php

<br>
<br>

## 开始使用

初始化中传入的数值应使用字符串，譬如有一个取出数值并计算后返回给前端的接口，数据库中存储的类型为 decimal 时，应优先将取出的值初始化为 BigNumber，然后在代码中使用 BigNumber 进行计算，后在接口返回处使用：value() 方法获取字符串型的数值输出

#### 1.方式一：使用 new 语句

	$number = new \chawuciren\BigNumber('0.002', 3);

#### 2.方式二：使用静态方法 build

	$number = \chawuciren\BigNumber::build('0.002', 3);

#### 3.方式三：使用 valueOf 方法赋值

	$number = new \chawuciren\BigNumber();
	$number->valueOf('0.002', 3);

<br>
<br>

## 方法列表

#### 1.valueOf

设置一个值到BigNumber实例中 

##### 参数:

| 参数名 | 类型 | 说明 |
|--|--|--|
| number | String/BigNumber | 字符串或BigNumber类型的数字 |
| scale| Int | 数字精度 |

##### 返回值: BigNumber(当前实例)

##### 示例:

	$number = new \chawuciren\BigNumber();
	$number->valueOf('0.002', 3);
	var_dump($number); //object(chawuciren\BigNumber)

<br>

#### 2.toString

以字符串类型返回数值

##### 参数:

无

##### 返回值: String(当前数值)

##### 示例:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$str = $number->toString();
	var_dump($str); //string(5) "0.002"

#### 3.value

以字符串类型返回数值，当前为 toString 方法的别名

##### 示例:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$str = $number->value();
	var_dump($str); //string(5) "0.002"

<br>

#### 4.add

将当前数值加上传入的number值

##### 参数:

| 参数名 | 类型 | 说明 |
|--|--|--|
| number | String/BigNumber | 用于相加的数值 |

##### 返回值: BigNumber(当前实例)

##### 示例:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$number->add('0.003');
	var_dump($number->value()); //string(5) "0.005"

<br>

#### 5.sub

将当前数值减去传入的number值

##### 参数:

| 参数名 | 类型 | 说明 |
|--|--|--|
| number | String/BigNumber | 用于相减的数值 |

##### 返回值: BigNumber(当前实例)

##### 示例:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$number->sub('0.001');
	var_dump($number->value()); //string(5) "0.001"

<br>

#### 6.mul

将当前数值乘以传入的number值

##### 参数:

| 参数名 | 类型 | 说明 |
|--|--|--|
| number | String/BigNumber | 用于相乘的数值 |

##### 返回值: BigNumber(当前实例)

##### 示例:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$number->sub('0.001');
	var_dump($number->value()); //string(5) "0.001"

<br>

#### 7.div

将当前数值除以传入的number值

##### 参数:

| 参数名 | 类型 | 说明 |
|--|--|--|
| number | String/BigNumber | 将当前数值除以传入的number值 |

##### 返回值: BigNumber(当前实例)

##### 示例:

	$number = new \chawuciren\BigNumber('0.002', 3);
	$number->dev('2');
	var_dump($number->value()); //string(5) "0.001"

<br>

#### 8.mod

将当前数值用传入的number值取模

##### 参数:

| 参数名 | 类型 | 说明 |
|--|--|--|
| number | String/BigNumber | 用于取模的数值 |

##### 返回值: BigNumber(当前实例)

##### 示例:

	$number = new \chawuciren\BigNumber('108');
	$number->mod('10');
	var_dump($number->value()); //string(1) "8"

<br>

#### 9.pow

取当前数值的number次方

##### 参数:

| 参数名 | 类型 | 说明 |
|--|--|--|
| number | String/BigNumber | 乘方的数值 |

##### 返回值: BigNumber(当前实例)

##### 示例:

	$number = new \chawuciren\BigNumber('2');
	$number->pow('2');
	var_dump($number->value()); //string(1) "4"

<br>

未完待续...


