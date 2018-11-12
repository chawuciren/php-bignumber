# php-bignumber

用于更方便的解决PHP中大数字和浮点数精度问题

###  安装方式

---

首先请确保你的 PHP 已经安装并支持 BC Math 扩展，如果不支持，具体安装方式参照官网：http://php.net/manual/en/bc.installation.php

查看方式：

	php -info | grep bcmath

如果能够看到输出

	bcmath
	bcmath.scale => 0 => 0

则表示 BC Math 可以使用

---

开始安装：

#### 1.composer

	composer require chawuciren/bignumber

#### 2.include
直接下载源码，引入 src/BigNumber.php

<br>
<br>

### 开始使用

---

##### 1.使用 new 语句

	$number = new \chawuciren\BigNumber('0.002', 3);

##### 2.使用静态方法 build

	$number = \chawuciren\BigNumber::build('0.002', 3);

##### 3.使用 valueOf 方法赋值

	$number = new \chawuciren\BigNumber();
	$number->valueOf('0.002', 3);

<br>
<br>

### 方法列表

---

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


