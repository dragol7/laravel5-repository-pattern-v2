<?php

namespace App\Http\Controllers;

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
		return $this->repo->all();
	}

}
