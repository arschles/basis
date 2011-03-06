<?php
require_once "Basis_Type_Base.php";

class Basis_Type_Int extends Basis_Type_Base
{
    public function validate($data)
    {
        return is_int($data);
    }

	public function increment()
	{
	    $inc = $this->get() + 1;
		$this->set($inc);
		return $inc;
	}
	
	public function getAndIncrement()
	{
		$val = $this->get();
		$this->increment();
		return $val;
	}
	
	public function decrement()
	{
	    $dec = $this->get() - 1;
		$this->set($dec);
		return $dec;
	}
	
	public function getAndDecrement()
	{
		$val = $this->get();
		$this->decrement();
		return $val;
	}
}