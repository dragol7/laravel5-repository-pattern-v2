<?php

namespace App\Repositories;

use App\Customer;
use App\Repositories\Eloquent\Repository;
use Illuminate\Support\Collection;

class CustomerRepository extends Repository
{
	public function __construct(Customer $customer, Collection $collection)
	{
		parent::__construct($customer, $collection);
	}
}