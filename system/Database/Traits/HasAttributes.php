<?php namespace system\Database\Traits;

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

trait HasAttributes{


private function registerAttribute($object,string $attribute,$value){
    $this->inCastsAttributes($attribute) == true ? $object->$attribute = $this->castDecodeValue($attribute,$value) : $object->$attribute = $value;

}

protected function arrayToAttribute(array $array,$object = null){
  if(!$object){
      $className = get_called_class();
      $object = new $className;
  }

  foreach($array as $attribute=>$value){
      if($this->inHidddenAttributes($attribute))
        continue;
      $this->registerAttribute($object,$attribute,$value);
  }

  return $object;
}

protected function arrayToObjects(array $array){
  $collection = [];

  foreach($array as $value){
    $object = $this->arrayToAttribute($array);
    array_push($collection,$object);
  }
  $this->collection = $collection;

}

private function inHidddenAttributes($attribute){

  return (in_array($attribute,$this->hidden));
}

private function inCastsAttributes($attribute){
  return (in_array($attribute,array_keys($this->casts))) ;

}

private function castDecodeValue($attributeKey,$value){

  if($this->casts[$attributeKey] == 'array' || $this->casts[$attributeKey] == 'object')
      return unserialize($value);
  return $value;
}

private function castEncodeValue($attributeKey,$value){

  if($this->casts[$attributeKey] == 'array' || $this->casts[$attributeKey] == 'object')
      return serialize($value);
  return $value;
}

private function arrayToCastAttributes($values){
  $newArray = [];
  foreach($values as $attribute=>$value){
    if($this->inCastsAttributes($attribute))
      $newArray[$attribute] = $this->castEncodeValue($attribute,$value);

    $newArray[$attribute] = $value;

  }

  return $newArray;
}


}