<?php
/**
*
* Class DAO -> DBA get, delete, insert, update objects
*
* author: Xiaoyu Tai @ Beijing, 2014.4.25
*
*/

namespace Base;

abstract class DAO extends MySQL{
  abstract public function getObjectByID($Object_id);
  abstract public function insertObject($Object);
  abstract public function updateObject($Object);
  abstract public function deleteObject($Object);
  abstract public function deleteObjectByID($Object_id);
  abstract public function totalNum($variable);
}