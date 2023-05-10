<?php 

class OneToMany
{ 
    public function oneToMany($data, $oneToMany, $pdo, $primaryKey)
    {
        $idGroup = [];
        foreach ($data as $dataItem) {
            $idGroup[] = $dataItem->$primaryKey;
        }

        $in  = str_repeat('?,', count($idGroup) - 1) . '?';

        $dataRelation = [];
        foreach ($oneToMany as $oneToManyItem) {
            list($tableRelation, $foreignKey) = array_values($oneToManyItem);

            $sqlRelation = "SELECT * FROM $tableRelation WHERE $foreignKey IN ($in)";
            $stmt = $pdo->prepare($sqlRelation);
            $stmt->execute($idGroup);
            $dataRelation[$tableRelation] = $stmt->fetchAll(PDO::FETCH_OBJ); 
        }  
        
        return $dataRelation;
    }
}