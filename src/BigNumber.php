<?php
namespace chawuciren;

class BigNumber
{
    //当前数值的字符串类型
    protected $numberValue          = '0';
    //数值精度
    protected $numberScale          = 0;
    //类名和命名空间
    protected $currentFullClassName = '';

    /**
     * @brief 构造
     *
     * @param $number String/BigNumber 字符串或BigNumber类型的数字
     * @param $scale Int 数字精度
     *
     * @return null
     */
    public function __construct($number = '0', $scale = null)
    {
        $this->valueOf($number, $scale);
    }

    /**
     * @brief 构造一个新的BigNumber实例
     *
     * @param $number String/BigNumber 字符串或BigNumber类型的数字
     * @param $scale Int 数字精度
     *
     * @return null
     */
    public static function build($number, $scale = null)
    {
        return new self($number, $scale);
    }

    /**
     * @brief 设置一个值到BigNumber实例中
     *
     * @param $number String/BigNumber 字符串或BigNumber类型的数字
     * @param $scale Int 数字精度
     *
     * @return null
     */
    public function valueOf($number = '0', $scale = null)
    {
        $this->numberValue = $this->numberToString($number);
        if ($scale !== null) {
            $this->numberScale = intval($scale);
        }
        $this->numberValue = bcadd($this->numberValue, '0', $this->numberScale);

        return $this;
    }

    /**
     * @brief 以字符串类型返回数值
     *
     * @return String
     */
    public function toString()
    {
        return strval($this->numberValue);
    }

    /**
     * @brief 返回BigNumber实例中的数值,当前默认为字符串类型
     *
     * @return String
     */
    public function value()
    {
        return $this->toString();
    }

    /**
     * @brief 初始化成员变量中的完整类名和命名空间
     *
     * @return null
     */
    public function initCurrentFullClassName()
    {
        if (empty($this->currentFullClassName)) {
            $this->currentFullClassName = get_class();
        }
    }

    /**
     * @brief 将传入的number参数转为字符串类型
     *
     * @param $number String/Int/Float/Double/Long/Bool/BigNumber number参数
     *
     * @return String
     */
    public function numberToString($number = '0')
    {
        $this->initCurrentFullClassName();

        if (is_object($number) && get_class($number) == $this->currentFullClassName) {
            $number = $number->toString();
        } else if (is_int($number) || is_float($number) || is_double($number) || is_long($number)) {
            $number = strval($number);
        } else if (is_bool($number)) {
            $number = intval($number);
            $number = strval($number);
        } else if (is_null($number)) {
            $number = '0';
        } else if (is_string($number) && $number === '') {
            $number = '0';
        } else if (is_string($number)) {
            $number = $number;
        } else {
            $number = '0';
        }

        return $number;
    }

    /**
     * @brief 将当前数值加上传入的number值
     *
     * @param $number String/BigNumber 用于相加的数值
     *
     * @return BigNumber BigNumber类型的实例
     */
    public function add($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcadd($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    /**
     * @brief 将当前数值减去传入的number值
     *
     * @param $number String/BigNumber 用于相减的数值
     *
     * @return BigNumber BigNumber类型的实例
     */
    public function sub($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcsub($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    /**
     * @brief 将当前数值乘以传入的number值
     *
     * @param $number String/BigNumber 用于相乘的数值
     *
     * @return BigNumber BigNumber类型的实例
     */
    public function mul($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcmul($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    /**
     * @brief 将当前数值除以传入的number值
     *
     * @param $number String/BigNumber 用于相除的数值
     *
     * @return BigNumber BigNumber类型的实例
     */
    public function div($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcdiv($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    /**
     * @brief 将当前数值用传入的number值取模
     *
     * @param $number String/BigNumber 用于取模的数值
     *
     * @return BigNumber BigNumber类型的实例
     */
    public function mod($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcmod($this->numberValue, $number);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    /**
     * @brief 取当前数值的number次方
     *
     * @param $number String/BigNumber 乘方的数值
     *
     * @return BigNumber BigNumber类型的实例
     */
    public function pow($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcpow($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    /**
     * @brief 取当前数值的平方根
     *
     * @return BigNumber BigNumber类型的实例
     */
    public function sqrt()
    {
        $number            = bcsqrt($this->numberValue, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    /**
     * @brief 判断当前数值是否等于number值
     *
     * @param $number String/BigNumber 参与判断的右值
     *
     * @return Bool true:相等; false:不相等
     */
    public function eq($number = '0')
    {
        $number = $this->numberToString($number);
        $comp   = bccomp($this->numberValue, $number, $this->numberScale);

        if ($comp === 0) {
            return true;
        }

        return false;
    }

    /**
     * @brief 判断当前数值是否大于number值
     *
     * @param $number String/BigNumber 参与判断的右值
     *
     * @return Bool true:大于; false:不大于
     */
    public function gt($number = '0')
    {
        $number = $this->numberToString($number);
        $comp   = bccomp($this->numberValue, $number, $this->numberScale);

        if ($comp === 1) {
            return true;
        }

        return false;
    }

    /**
     * @brief 判断当前数值是否大于number值
     *
     * @param $number String/BigNumber 参与判断的右值
     *
     * @return Bool true:大于; false:不大于
     */
    public function egt($number = '0')
    {
        $number = $this->numberToString($number);

        if ($this->eq($number) || $this->gt($number)) {
            return true;
        }

        return false;
    }

    /**
     * @brief 判断当前数值是否小于number值
     *
     * @param $number String/BigNumber 参与判断的右值
     *
     * @return Bool true:小于; false:不小于
     */
    public function lt($number = '0')
    {
        $number = $this->numberToString($number);
        $comp   = bccomp($this->numberValue, $number, $this->numberScale);

        if ($comp === -1) {
            return true;
        }

        return false;
    }

    /**
     * @brief 判断当前数值是否小于number值
     *
     * @param $number String/BigNumber 参与判断的右值
     *
     * @return Bool true:小于; false:不小于
     */
    public function elt($number = '0')
    {
        $number = $this->numberToString($number);

        if ($this->eq($number) || $this->lt($number)) {
            return true;
        }

        return false;
    }
}
