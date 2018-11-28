<?php

class DatabaseInteractor
{
    public $conn;
    public $DBInteractor = null;
    function dbConnect()
    {
        $servername = AppConfig::SQL_SERVERNAME;
        $database = AppConfig::SQL_DATABASE;
        $username = AppConfig::SQL_USERNAME;
        $password = AppConfig::SQL_PASSWORD;
        try
        {
            if($this->conn == null)
            {
                $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->exec("set names utf8");
            }
        }
        catch(PDOException $e)
        {
            return;
        }
    }

    function selectWithQuery($query, $param = null)
    {
        try{
            $this->dbConnect();
            $stmt = $this->conn->prepare($query);
            if($param==null)
                $stmt->execute();
            else
                $stmt->execute($param);
            $result = $stmt->setFetchMode(PDO::FETCH_NAMED);

            $resultSet = $stmt->fetchAll();
            if(! Utility::isEmpty($resultSet) || $resultSet != false)
                return $resultSet;
            else
                return null;
        }
        catch(PDOException  $e)
        {

            return null;
        }
    }

    function insertWithQuery($query, $param)
    {
        try
        {
            $this->dbConnect();
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare($query);
            $stmt->execute($param);
            $this->conn->commit();
            return true;
        }
        catch(PDOException $e)
        {

            $this->conn->rollback();
            return false;
        }
    }

    function insertWithQueryGetLastId($query, $param, $strColForId)
    {
        try
        {
            $lastId = 0;
            $this->dbConnect();
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare($query);
            $stmt->execute($param);
            $lastId = $this->conn->lastInsertId($strColForId);
            $this->conn->commit();
            return $lastId;
        }
        catch(PDOException $e)
        {
            $this->conn->rollback();
            return 0;
        }
    }

    function callNoReturnProcedure($procName, $lstInParams=null)
    {
        try
        {
            $this->dbConnect();
            $procCall = 'CALL `'.$procName."`";

            if($lstInParams != null)
                $procCall .='(';

            if($lstInParams != null)
            {
                $inCount = 0;
                foreach($lstInParams as &$val)
                {
                    if($val == Constants::STR_EMPTY) $val = null;
                    $procCall .= "'".$val."'";

                    if ((count($lstInParams)-1)!=$inCount) $procCall .= ",";
                    $inCount ++;
                }
            }

            if($lstInParams != null)
                $procCall .=')';

            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare($procCall);
            $stmt->execute();

            $this->conn->commit();
            return true;
        }
        catch(PDOException $e)
        {

            $this->conn->rollBack();
            return false;
        }
    }

    function callProcedure($procName, $lstInParams=null, $lstOutParams=null)
    {
        try
        {
            $this->dbConnect();
            $procCall = 'CALL `'.$procName."`";

            if($lstInParams != null || $lstOutParams != null)
                $procCall .='(';

            if($lstInParams != null)
            {
                $inCount = 0;
                foreach($lstInParams as &$val)
                {
                    if($val == Constants::STR_EMPTY) $val = null;
                    $procCall .= "'".$val."'";

                    if ((count($lstInParams)-1)!=$inCount) $procCall .= ",";
                    $inCount ++;
                }
            }

            if($lstOutParams != null)
            {
                $outlist=Constants::STR_EMPTY;
                $outSelect = Constants::STR_EMPTY;
                $outCount = 0;
                foreach($lstOutParams as &$val)
                {
                    $outlist .= $val;
                    $outSelect .= $val." as `". $val. "`";
                    if ((count($lstOutParams)-1)!=$outCount)
                    {
                        $outlist .= ",";
                        $outSelect.= ",";
                        $outCount++;
                    }
                }
                $procCall .= "," . $outlist;
            }

            if($lstInParams != null || $lstOutParams != null)
                $procCall .=')';

            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare($procCall);
            $stmt->execute();

            if($lstOutParams != null)
            {
                $selectQuery = 'SELECT '.$outSelect;
                $resultset = $this->selectWithQuery($selectQuery);
                $this->conn->commit();
                return $resultset;
            }

            return null;
        }
        catch(PDOException $e)
        {

            $this->conn->rollBack();
            return null;
        }
    }
}


?>