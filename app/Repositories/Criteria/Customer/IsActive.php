<?php

namespace App\Repositories\Criteria\Customer;

use App\Repositories\Criteria\Criteria;
use App\Repositories\Eloquent\Repository;

class IsActive extends Criteria
{
	public function apply($model, Repository $repo)
	{
		$query = $model->where('is_active', '=', 1);
		return $query;
	}
}