<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\IRepository;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements IRepository
{
	protected $model;
	
	public function __construct($model)
	{
		if (!$model instanceof Model) {
			throw new RepositoryException("Class " . get_class($model) . " must be an instance of Illuminate\\Database\\Eloquent\\Model");
		}
		$this->model = $model;
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
}