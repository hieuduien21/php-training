<?php

class Model
{
    protected $table;
    private $pdo;
    private $where = [];
    private $select = null;
    private $groupBy = null;
    private $having = null;
    private $orderBy = null;
    private $limit = null;
    private $offset = null;
    private $join = [];
    private $attribute = [];

    public function __set($name, $value)
    {
        $this->attribute[$name] = $value;
    }

    public function __get ($name)
    {
        $this->$name();
    }

    public function __construct()
    {
        $this->pdo = $this->connectPDO();
    }

    public function insert($data): bool | int
    {
        $columnKey = array_keys($data);
        $columns = implode(', ', $columnKey);

        $placeHolderSql = array_map(function ($item) {
            return ":$item";
        }, $columnKey);
        $placeHolderSql = implode(', ', $placeHolderSql);

        // cach 2
        // $placeHolderSql = array_map(function ($item) {
        //     return "?";
        // }, $columnKey);
        // $placeHolderSql = implode(',', $placeHolderSql);
        // $data = array_values($data);
        // het cach 2

        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeHolderSql)";

        $stmt = $this->pdo->prepare($sql);
        $dataExcute = $stmt->execute($data);
        if ($dataExcute) {
            $lastInsertId = $this->pdo->lastInsertId();
        }
        if ($lastInsertId) {
            return $lastInsertId;
        }
        return false;
    }

    public function connectPDO(): object
    {
        $host = '127.0.0.1';
        $db   = 'buoi3';
        $user = 'root';
        $pass = 'root';
        $port = "3306";
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

        try {
            return new \PDO($dsn, $user, $pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function update($data): bool
    {
        $values = array_values($data);
        $whereValue = array_map(function ($item) {
            return $item['value'];
        }, $this->where);
        $values = array_merge($values, $whereValue);
        $columns = array_keys($data);

        $placeHolderSql = implode(', ', array_map(function ($item) {
            return "$item=?";
        }, $columns));

        $where = implode(', ', array_map(function ($item) {
            return $item['column'] . $item['operator'] . "?";
        }, $this->where));

        $sql = "UPDATE $this->table SET $placeHolderSql WHERE ";
        if ($this->where) {
            $sql = $sql . $where;
        }

        $id = $this->pdo->prepare($sql)->execute($values);
        return $id ? true : false;
    }

    public function update2($data): bool
    {
        list($whereAnd, $dataExcute) = $this->whereAnd();

        $columns = array_keys($data);
        $placeHolderSql = implode(', ', array_map(function ($item) {
            return "$item=:$item";
        }, $columns));

        $sql = "UPDATE $this->table SET $placeHolderSql WHERE ";
        if ($this->where) {
            $sql = $sql . $whereAnd;
        }

        $dataExcute = array_merge($data, $dataExcute);

        $id = $this->pdo->prepare($sql)->execute($dataExcute);
        return $id ? true : false;
    }

    public function delete()
    {
        list($where, $dataExcute) = $this->whereAnd();

        $sql = "DELETE FROM $this->table WHERE ";
        if ($this->where) {
            $sql .= $where;
        }

        $this->pdo->prepare($sql)->execute($dataExcute);
    }

    public function select($select)
    {
        $this->select = $select ? $select : '*';
        return $this;
    }

    public function get()
    {
        $sql = "SELECT ";
        if ($this->select) {
            $sql .= "$this->select FROM $this->table";
        }

        if ($this->join) {
            foreach ($this->join as $join) {
                $sql .= " $join[type] JOIN $join[tableJoin] ON $join[condition] ";
            }
        }

        if ($this->where) {
            list($where, $dataWhere) = $this->whereAnd();
            $sql .= " WHERE $where";
        }

        if ($this->groupBy) {
            $sql .= " GROUP BY $this->groupBy";
        }

        if ($this->having) {
            $sql .= " HAVING $this->having";
        }

        if ($this->orderBy) {
            $sql .= " ORDER BY $this->orderBy";
        }

        if (is_numeric($this->limit)) {
            if (is_numeric($this->offset)) {
                $sql .= " LIMIT  $this->limit OFFSET $this->offset";
            } else {
                $sql .= " LIMIT $this->limit";
            }
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(!empty($dataWhere) ? $dataWhere : []);
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function groupBy($groupBy)
    {
        $this->groupBy = $groupBy;
        return $this;
    }

    public function having($having)
    {
        $this->having = $having;
        return $this;
    }

    public function orderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function limit($limit, $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    private function whereAnd()
    {
        $tmpWhere = [];
        $dataWhere = [];
        foreach ($this->where as $key => $valueWhere) {
            $keyWhere = 'where_' . $key;
            $tmpWhere[] = $valueWhere['column'] . $valueWhere['operator'] . ":" . $keyWhere;
            $dataWhere[$keyWhere] = $valueWhere['value'];
        }
        $tmpWhere = implode(' AND ', $tmpWhere);
        return [$tmpWhere, $dataWhere];
    }

    public function where()
    {
        $numArg = func_num_args();
        $args = func_get_args();
        if ($numArg === 2) {
            $column = $args[0];
            $operator = '=';
            $value = $args[1];
        } else if ($numArg === 3) {
            $column = $args[0];
            $operator = $args[1];
            $value = $args[2];
        } else {
            $column = null;
            $operator = null;
            $value = null;
        }
        $this->where[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
        ];

        return $this;
    }

    public function whereArray($array)
    {
        if (is_array($array) && count($array) === 1) {
            $array = [$array];
        }

        foreach ($array as $item) {
            list($column, $operator, $value) = $item;
            $this->where($column, $operator, $value);
            // $this->where[] = [
            //     'column' => $column,
            //     'operator' => $operator,
            //     'value' => $value,
            // ];
        }
        return $this;
    }

    public function join($tableJoin, $condition)
    {
        $this->join[] = [
            'type' => 'INNER',
            'tableJoin' => $tableJoin,
            'condition' => $condition
        ];
        return $this;
    }

    public function save()
    {
        return $this->insert($this->attribute);
    }

    public function hasMany($className, $foreignKey)
    {
        $data = $this->get();
        $instanceClass = new $className();
        $table = $instanceClass->table;

        $sql = " select * from $table where $foreignKey in ($data..)";
    }

    public function with($modelRelation)
    {
        return $this->$modelRelation();
    }
}
