<?php

class Basis_Type_Ranged_Int extends Basis_Type_Int
{
	const IN_RANGE = 0;
	const ABOVE_RANGE = 1;
	const BELOW_RANGE = 2;
	
	private $min;
	private $max;
	private $exception = false;
	
    public function __construct($min, $max, $start)
	{
		parent::__construct();
		$this->min = $min;
		$this->max = $max;
		$this->exception = $exception;
		
		$this->set($start);
	}
	
	public function increment()
	{
		$this->set($this->get() + 1);
	}
	
	public function getAndIncrement()
	{
		$val = $this->get();
		$this->increment();
		return $val;
	}
	
	public function validate($val)
	{
		return parent::validate($val) && ($this->rangeStatus($val) != self::IN_RANGE);
	}
	
	public function rangeStatus($val)
	{
		$max = $this->max;
		$min = $this->min;
		if($val > $max) return self::ABOVE_RANGE;
		else if($val < $min) return self::BELOW_RANGE;
		return self::IN_RANGE;
	}
	
	public function set($val)
	{		
		parent::set($val);
	}
}