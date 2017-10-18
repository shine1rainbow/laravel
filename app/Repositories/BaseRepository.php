<?php

namespace App\Repositories;

trait BaseRepository
{
    /**
     * Get numbers of records
     *
     * return array
     */
    public function getNumber()
    {
        return $this->model->count();
    }

    /**
     * Get all records
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * Get Model by id
     *
     * @param  int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update columns in the record by id.
     *
     * @param  int $id
     * @param  array $input
     * @return App\Tables\Model
     */
    public function updateColumn(int $id, array $input)
    {
        $this->model = $this->getById($id);

        foreach ($input as $k => $v) {
            $this->model->{$k} = $v;
        }

        return $this->model->save();
    }

    /**
     * Update a record by id.
     *
     * @param  int $id
     * @param  array $input
     * @return App\Tables\Model
     */
    public function update(int $id, array $input)
    {
        $this->model = $this->getById($id);
        return $this->save($this->model, $input);
    }

    /**
     * Destroy a model.
     *
     * @param  $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * Save the input's data.
     *
     * @param  $model
     * @param  $input
     * @return App\Tables\Model
     */
    public function save($model, $input)
    {
        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * Get number of the records
     *
     * @param  int $skip
     * @param  int $paginate
     * @param  string $sort
     * @param  string $sortColumn
     * @return Illuminate\Database\Eloquent\Paginate
     */
    public function page(int $skip = 0, int $paginate = 10, string $sort = 'desc', string $sortColumn = 'created_at')
    {
        return $this->model->skip($skip)->orderBy($sortColumn, $sort)->paginate($paginate);
    }

    /**
     * Store a new record.
     *
     * @param  array $input
     * @return App\Tables\Model
     */
    public function store(array $input)
    {
        return $this->save($this->model, $input);
    }
}
