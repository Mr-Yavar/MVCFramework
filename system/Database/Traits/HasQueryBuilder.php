<?php namespace system\Database\Traits;

use system\Database\DBConnection\DBConnection;

trait HasQueryBuilder
{
    private $sql = '';
    protected $where = [];
    private $orderBy = [];
    private $limit = [];
    private $values = [];
    private $bindvalues = [];

    protected function setSql($Query)
    {
        $this->sql = $Query;
    }
    protected function getSql()
    {
        return $this->sql;
    }
    protected function resetSql()
    {
        $this->sql = '';
    }

    protected function setWhere($operator, $condition)
    {
        $this->where[] = ['operator' => $operator, 'condition' => $condition];
    }

    protected function resetWhere()
    {
        $this->where = [];
    }

    protected function setOrderBy($name, $expression)
    {
        $this->orderBy[] = $this->getAttributeName($name) . ' ' . $expression;
    }

    protected function resetOrderBy()
    {
        $this->orderBy = [];
    }

    protected function setLimit($from, $number)
    {
        $this->limit['from'] = (int) $from;
        $this->limit['number'] = (int) $number;
    }

    protected function resetLimit()
    {
        unset($this->limit['from']);
        unset($this->limit['number']);

    }

    protected function addValue($attribute, $value)
    {
        $this->values[$attribute] = $value;
        $this->bindvalues[] = $value;
    }

    protected function removeValues()
    {
        $this->values = [];
        $this->bindvalues = [];

    }

    protected function resetQuery()
    {
        $this->resetSql();
        $this->resetWhere();
        $this->resetOrderBy();
        $this->resetLimit();
        $this->removeValues();
    }

    protected function executeQuery()
    {

        $query = '';
        $query .= $this->sql;
        if (!empty($this->where)) {
            $wherestring = '';
            foreach ($this->where as $where) {
                ($wherestring == '') ? ($wherestring .= $where['condition']) : ($wherestring .= ' ' . $where['operator'] . ' ' . $where['condition']);
            }

            $query .= ' WHERE ' . $wherestring;
        }

        if (!empty($this->orderBy)) {
            $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
        }

        if (!empty($this->limit)) {
            $query .= ' LIMIT ' . $this->limit['from'] . ', ' . $this->limit['number'] . ' ';
        }

        $query .= ' ;';
        echo $query . '</hr>';

        $pdoInstance = DBConnection::GetDBConnectionInstance();
        $statement = $pdoInstance->prepare($query);
        if (sizeof($this->bindvalues) > sizeof($this->values)) {
            sizeof($this->bindvalues) > 0 ? $statement->execute($this->bindvalues) : $statement->execute();
        } else {
            sizeof($this->values) > 0 ? $statement->execute($this->values) : $statement->execute();

        }

        return $statement;
    }

    protected function getCount(){
        $query = "SELECT COUNT(".$this->getTableName().".*) FROM ".$this->getTableName();
        if (!empty($this->where)) {
            $wherestring = '';
            foreach ($this->where as $where) {
                ($wherestring == '') ? ($wherestring .= $where['condition']) : ($wherestring .= ' ' . $where['operator'] . ' ' . $where['condition']);
            }

            $query .= ' WHERE ' . $wherestring;
        }

        $query .= ' ;';

        $pdoInstance = DBConnection::GetDBConnectionInstance();
        $statement = $pdoInstance->prepare($query);
        if (sizeof($this->bindvalues) > sizeof($this->values)) {
            sizeof($this->bindvalues) > 0 ? $statement->execute($this->bindvalues) : $statement->execute();
        } else {
            sizeof($this->values) > 0 ? $statement->execute($this->values) : $statement->execute();
        }

        return $statement->fetchColumn();
    }

    protected function getTableName(){
        return ' `'.$this->table.'` ';
    }

    protected function getAttributeName($attribute){
        return ' `'.$this->table.'`.`'.$attribute.'` ';
    }
    
}
