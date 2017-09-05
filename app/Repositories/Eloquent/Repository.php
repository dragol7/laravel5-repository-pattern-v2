<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ICriteria;
use App\Repositories\Contracts\IRepository;
use App\Repositories\Criteria\Criteria;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Repository implements IRepository, ICriteria
{
	protected $model;

	protected $criteria;

	protected $skipCriteria = false;

	public function __construct($model, Collection $collection)
	{
		if (!$model instanceof Model) {
			throw new RepositoryException("Class " . get_class($model) . " must be an instance of Illuminate\\Database\\Eloquent\\Model");
		}
		$this->model = $model;
		$this->criteria = $collection;
		$this->resetScope();
	}

	public function all($columns = array('*'))
	{
		return $this->model->get($columns);
	}

	public function paginate($perPage = 15, $columns = array('*'))
	{
		return $this->model->paginate($perPage, $columns);
	}

	public function create(array $data)
	{
		return $this->model->create($data);
	}

	public function update(array $data, $id, $attribute="id")
	{
		return $this->model->where($attribute, '=', $id)->update($data);
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}

	public function find($id, $columns = array('*'))
	{
		return $this->model->find($id, $columns);
	}

	public function findBy($attribute, $value, $columns = array('*'))
	{
		return $this->model->where($attribute, '=', $value)->first($columns);
	}

	public function resetScope()
	{
		$this->skipCriteria(false);
		return $this;
	}

	public function skipCriteria($status = true)
	{
		$this->skipCriteria = $status;
		return $this;
	}

	public function getCriteria()
	{
		return $this->criteria;
	}

	public function getByCriteria(Criteria $criteria)
	{
		$this->model = $criteria->apply($this->model, $this);
		return $this;
	}

	public function pushCriteria(Criteria $criteria)
	{
		$this->criteria->push($criteria);
		return $this;
	}

	public function applyCriteria()
	{
		if($this->skipCriteria === true)
			return $this;

		foreach ($this->getCriteria() as $criteria) {
			if($criteria instanceof  Criteria)
				$this->model = $criteria->apply($this->model, $this);
		}
	}
}