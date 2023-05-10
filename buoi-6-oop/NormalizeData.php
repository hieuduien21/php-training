<?php

class NormalizeData
{
    public function NormalizeDataOneToMany($data, $dataRelation, $oneToMany, $primaryKey)
    {
        foreach ($oneToMany as $oneToManyItem) {
            list($tableRelation, $foreignKey) = array_values($oneToManyItem);
        
            $dataRelationGroup = [];
            foreach ($dataRelation[$tableRelation] as $dataRelationItem) {
                $dataRelationGroup[$dataRelationItem->$foreignKey][] = $dataRelationItem;
            }
    
            foreach ($data as $dataItem) {
                $dataItem->$tableRelation = $dataRelationGroup[$dataItem->$primaryKey] ?? [];
            }
        } 
        
        return $data;
    }
}