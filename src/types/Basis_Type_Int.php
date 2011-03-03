<?php

class Basis_Type_Int extends Basis_Type_Base
{
    public function validate($data)
    {
        return is_int($data);
    }

	public function increment()
	{
		$this->set($this->get() + 1);
		return $this->get();
	}
	
	public function getAndIncrement()
	{
		$val = $this->get();
		$this->increment();
		return $val;
	}
	
	public function decrement()
	{
		$this->set($this->get() - 1);
	}
	
	public function getAndDecrement()
	{
		$val = $this->get();
		$this->decrement();
		return $val;
	}
}