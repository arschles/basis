<?php
require_once "Basis_Type_Int.php";

class Basis_Type_Ranged_Int extends Basis_Type_Int
{
	const IN_RANGE = 0;
	const ABOVE_RANGE = 1;
	const BELOW_RANGE = 2;
	
	private $min;
	private $max;
	
    public function __construct($min, $max, $start)
	{
		$this->min = $min;
		$this->max = $max;
		
		parent::__construct();
		$this->set($start);
	}
	
	public function validate($val)
	{
		return parent::validate($val) && ($this->rangeStatus($val) == self::IN_RANGE);
	}
	
	public function rangeStatus($val)
	{
		$max = $this->max;
		$min = $this->min;
		if($val > $max) return self::ABOVE_RANGE;
		else if($val < $min) return self::BELOW_RANGE;
		return self::IN_RANGE;
	}
	
	public function name()
	{
	    return 'Basis_Type_Ranged_Int (min = '.$this->min.', max = '.$this->max.', inclusive)';
	}
}