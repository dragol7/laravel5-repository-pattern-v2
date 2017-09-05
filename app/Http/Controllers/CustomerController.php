<?php

namespace App\Http\Controllers;

use App\Repositories\Criteria\Customer\IsActive;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $repo;
	
	public function __construct(CustomerRepository $repo)
	{
		$this->repo = $repo;
	}
	
	public function index()
	{
		$criteria = new IsActive();
		return $this->repo->getByCriteria($criteria)->all();
	}

}
