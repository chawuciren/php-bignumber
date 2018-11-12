<?php
namespace chawuciren\bignumber;

class BigNumber
{
    protected $numberValue          = '0';
    protected $numberScale          = 0;
    protected $currentFullClassName = '';

    public function __construct($number = '0', $scale = null)
    {
        $this->valueOf($number, $scale);
    }

    public static function build($number, $scale = null)
    {
        return new self($number, $scale);
    }

    public function valueOf($number = '0', $scale = null)
    {
        $this->numberValue = $this->numberToString($number);
        if ($scale !== null) {
            $this->numberScale = intval($scale);
        }
        $this->numberValue = bcadd($this->numberValue, '0', $this->numberScale);

        return $this;
    }

    public function toString()
    {
        return strval($this->numberValue);
    }

    public function value()
    {
        return $this->toString();
    }

    public function initCurrentFullClassName()
    {
        if (empty($this->currentFullClassName)) {
            $this->currentFullClassName = get_class();
        }
    }

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

    public function add($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcadd($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    public function sub($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcsub($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    public function mul($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcmul($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    public function div($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcdiv($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    public function mod($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcmod($this->numberValue, $number);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    public function pow($number = '0')
    {
        $number            = $this->numberToString($number);
        $number            = bcpow($this->numberValue, $number, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    public function sqrt()
    {
        $number            = bcsqrt($this->numberValue, $this->numberScale);
        $this->numberValue = $this->numberToString($number);
        return $this;
    }

    public function eq($number = '0')
    {
        $number = $this->numberToString($number);
        $comp   = bccomp($this->numberValue, $number, $this->numberScale);

        if ($comp === 0) {
            return true;
        }

        return false;
    }

    public function gt($number = '0')
    {
        $number = $this->numberToString($number);
        $comp   = bccomp($this->numberValue, $number, $this->numberScale);

        if ($comp === 1) {
            return true;
        }

        return false;
    }

    public function egt($number = '0')
    {
        $number = $this->numberToString($number);

        if ($this->eq($number) || $this->gt($number)) {
            return true;
        }

        return false;
    }

    public function lt($number = '0')
    {
        $number = $this->numberToString($number);
        $comp   = bccomp($this->numberValue, $number, $this->numberScale);

        if ($comp === -1) {
            return true;
        }

        return false;
    }

    public function elt($number = '0')
    {
        $number = $this->numberToString($number);

        if ($this->eq($number) || $this->lt($number)) {
            return true;
        }

        return false;
    }

}
