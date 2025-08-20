<?php

namespace App\Services;

class BaseService
{    
    /**
     * Fetches data from a specified URL using cURL.
     *
     * This function initializes a cURL session, sets the necessary options,
     * executes the session to retrieve data from the given URL, and then
     * closes the session. It returns the fetched data as a string.
     *
     * @param string $url The URL from which to fetch data.
     * @return string|false The fetched data as a string, or false on failure.
     * Example usage:
     * 
     * $query = User::query();
     * $conditions = [
     *     'user_id'   => 1,
     *     'is_active' => 1
     * ];
     * $orderBy = [
     *     'name'      => 'DESC',
     * ];
     * $options = [
     *     'pluck' => [
     *         'key'   => 'id',
     *         'value' => 'name'
     *     ],
     *     'paginate' => true or 20
     * ];
     * 
     * $data = $this->getData($query, $conditions, $options);
     */
    public function getData($query, $conditions = [], $options = [])
    {
        if(!empty($conditions)) {
            foreach ($conditions as $key => $value) {
                $query->where($key, $value);
            }
        }
        if (!empty($options['orderBy'])) {
            foreach ($options['orderBy'] as $key => $order) {
                $query->orderBy($key, $order);
            }
        }
        if (!empty($options['pluck'])) {
            return $query->pluck($options['pluck']['value'], $options['pluck']['key']);
        }
        if (!empty($options['paginate'])) {
            return $query->paginate($options['paginate'] === true ? maxPaginateNo() : $options['paginate']);
        }
       
        return $query->get();
    }
    
    /**
     * Fetches a single record by its primary key value with optional conditions.
     *
     * This function initializes a query on the given model, applies the primary key
     * value and any additional conditions, and returns the first matching record.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query The Eloquent query builder instance.
     * @param mixed $primaryKeyValue The value of the primary key to search for.
     * @param array $conditions Optional additional conditions to apply to the query.
     * @return \Illuminate\Database\Eloquent\Model|null The first matching record, or null if none found.
     * Example usage:
     * 
     * $model = User::query();
     * $primaryKeyValue = 1;
     * $conditions = [
     *     'is_active' => 1
     * ];
     * 
     * $data = $this->getDataById($model, $primaryKeyValue, $conditions);
     */
    public function getDataById($query, $primaryKeyValue, $conditions = [])
    {
        $query->where('id', $primaryKeyValue);

        if(!empty($conditions)) {
            foreach ($conditions as $key => $value) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    /**
     * Maps data from a query based on specified conditions and options.
     *
     * This function applies conditions and ordering to the query, and then
     * plucks the specified key-value pairs from the result set.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query The Eloquent query builder instance.
     * @param array $conditions Optional conditions to apply to the query.
     * @param array $options Options for ordering and plucking data.
     * @return \Illuminate\Support\Collection The collection of key-value pairs.
     * Example usage:
     * 
     * $query = User::query();
     * $conditions = [
     *     'is_active' => 1
     * ];
     * $options = [
     *     'orderBy' => [
     *         'name' => 'ASC'
     *     ],
     *     'pluck' => [
     *         'key' => 'id',
     *         'value' => 'name'
     *     ]
     * ];
     * 
     * $data = $this->map($query, $conditions, $options);
     */
    public function map($query, $conditions = [], $options = [])
    {
        if(!empty($conditions)) {
            foreach ($conditions as $key => $value) {
                $query->where($key, $value);
            }
        }
        if (!empty($options['orderBy'])) {
            foreach ($options['orderBy'] as $key => $order) {
                $query->orderBy($key, $order);
            }
        }
               
        return $query->pluck($options['pluck']['value'], $options['pluck']['key']);
    }
}