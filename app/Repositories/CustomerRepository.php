<?php

namespace App\Repositories;

use App\Customer;
use App\Repositories\Eloquent\Repository;

class CustomerRepository extends Repository
{
	public function __construct(Customer $customer)
	{
		parent::__construct($customer);
	}
}